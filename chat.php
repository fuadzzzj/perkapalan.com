<?php
require __DIR__ . '/service/database.php';
session_start();
if (empty($_SESSION['is_login'])) { header('Location: halaman_login.php'); exit; }
$userId = (int) $_SESSION['user_id'];
$name = $_SESSION['nama_lengkap'] ?? $_SESSION['username'];
$escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['pesan'] ?? ''); $mediaPath = null; $mediaType = null; $media = $_FILES['media'] ?? null;
    if ($media && $media['error'] === UPLOAD_ERR_OK && $media['size'] > 0) {
        $types = ['image/jpeg'=>'image','image/png'=>'image','image/webp'=>'image','video/mp4'=>'video','video/webm'=>'video','audio/mpeg'=>'audio','audio/ogg'=>'audio','audio/webm'=>'audio','audio/wav'=>'audio'];
        $detected = (new finfo(FILEINFO_MIME_TYPE))->file($media['tmp_name']); $limits = ['image'=>8*1024*1024,'video'=>30*1024*1024,'audio'=>15*1024*1024];
        if (isset($types[$detected]) && $media['size'] <= $limits[$types[$detected]]) { $mediaType=$types[$detected]; $folder=__DIR__.'/uploads/chat'; if(!is_dir($folder)) mkdir($folder,0755,true); $ext=strtolower(pathinfo($media['name'],PATHINFO_EXTENSION)); $stored=bin2hex(random_bytes(12)).'.'.$ext; if(move_uploaded_file($media['tmp_name'],$folder.'/'.$stored)) $mediaPath='uploads/chat/'.$stored; }
    }
    if ($message !== '' || $mediaPath) { $stmt=$db->prepare('INSERT INTO chat (user_id,pesan,media_path,media_type) VALUES (?,?,?,?)'); $stmt->bind_param('isss',$userId,$message,$mediaPath,$mediaType); $stmt->execute(); $stmt->close(); }
    header('Location: chat.php'); exit;
}
$messages=$db->query('SELECT c.pesan,c.media_path,c.media_type,c.created_at,u.nama_lengkap,u.role FROM chat c JOIN user u ON u.id=c.user_id ORDER BY c.created_at ASC LIMIT 100');
?><!doctype html>
<html lang="id"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ruang Chat | Perkapalan</title>
    <link rel="stylesheet" href="format_css/chat_modern.css"></head>
    <body>
        <main class="chat-shell">
            <header><div class="chat-brand"><a class="back-link" href="<?php echo ($_SESSION['role']??'siswa')==='guru'?'admin.php':'dashboard.php'; ?>">‹</a><div class="group-avatar">⚓</div><div><h1>Ruang Chat Bersama</h1><p>Pelajar dan guru</p></div></div><span class="header-dots">•••</span></header>
<section class="messages"><?php while($row=$messages->fetch_assoc()): ?><article class="message <?php echo $row['nama_lengkap']===$name?'mine':''; ?>"><div class="message-meta"><b><?php echo $escape($row['nama_lengkap']); ?></b><span><?php echo $row['role']==='guru'?'Guru':'Pelajar'; ?> · <?php echo $escape(date('d M H:i',strtotime($row['created_at']))); ?></span></div><?php if($row['pesan']!==''): ?><p><?php echo nl2br($escape($row['pesan'])); ?></p><?php endif; ?><?php if($row['media_type']==='image'): ?><img class="chat-media" src="<?php echo $escape($row['media_path']); ?>" alt="Foto kiriman"><?php elseif($row['media_type']==='video'): ?><video class="chat-media" controls src="<?php echo $escape($row['media_path']); ?>"></video><?php elseif($row['media_type']==='audio'): ?><audio controls src="<?php echo $escape($row['media_path']); ?>"></audio><?php endif; ?></article><?php endwhile; ?></section>
<form class="composer" method="post" enctype="multipart/form-data"><button class="attach-toggle" type="button" aria-label="Buka lampiran">＋</button><div class="attach-menu"><label>▣ <span>Dokumen<input type="file" class="picker" accept=".pdf,.doc,.docx,.zip"></span></label><label>▧ <span>Foto & video<input type="file" class="picker" accept="image/*,video/*"></span></label><label>◉ <span>Kamera<input type="file" class="picker" accept="image/*" capture="environment"></span></label><label>◉ <span>Audio<input type="file" class="picker" accept="audio/*"></span></label></div><input id="media-input" type="file" name="media" hidden><input name="pesan" placeholder="Tulis pesan" maxlength="1000" autocomplete="off"><button class="live-camera" type="button">Kamera langsung</button><button class="live-voice" type="button">Rekam suara</button><button class="send-button" type="submit" aria-label="Kirim">➤</button></form></main>
<script>
const form=document.querySelector('.composer'),mediaInput=document.querySelector('#media-input'),messageInput=form.querySelector('input[name=pesan]');
const attach=(file)=>{const dt=new DataTransfer();dt.items.add(file);mediaInput.files=dt.files;messageInput.placeholder=file.name};
document.querySelectorAll('.picker').forEach(picker=>picker.addEventListener('change',()=>{if(picker.files[0]){attach(picker.files[0]);document.querySelector('.attach-menu').classList.remove('open')}}));
form.querySelector('.attach-toggle').onclick=()=>document.querySelector('.attach-menu').classList.toggle('open');
let recorder=null,parts=[],stream=null;
form.querySelector('.live-voice').onclick=async()=>{const button=form.querySelector('.live-voice');if(recorder?.state==='recording'){recorder.stop();button.textContent='Rekam suara';return}try{stream=await navigator.mediaDevices.getUserMedia({audio:true});parts=[];recorder=new MediaRecorder(stream);recorder.ondataavailable=e=>parts.push(e.data);recorder.onstop=()=>{attach(new File([new Blob(parts,{type:'audio/webm'})],'rekaman-suara.webm',{type:'audio/webm'}));stream.getTracks().forEach(t=>t.stop())};recorder.start();button.textContent='Berhenti merekam'}catch(e){alert('Izinkan akses mikrofon di browser.')}};
form.querySelector('.live-camera').onclick=async()=>{try{const camera=await navigator.mediaDevices.getUserMedia({video:true});const modal=document.createElement('div');modal.className='camera-modal';modal.innerHTML='<div class="camera-box"><video autoplay playsinline></video><button type="button" class="capture-button">Ambil foto</button><button type="button" class="close-camera">Tutup</button></div>';document.body.append(modal);const video=modal.querySelector('video');video.srcObject=camera;modal.querySelector('.capture-button').onclick=()=>{const canvas=document.createElement('canvas');canvas.width=video.videoWidth;canvas.height=video.videoHeight;canvas.getContext('2d').drawImage(video,0,0);canvas.toBlob(blob=>{attach(new File([blob],'foto-kamera.jpg',{type:'image/jpeg'}));camera.getTracks().forEach(t=>t.stop());modal.remove()},'image/jpeg',.9)};modal.querySelector('.close-camera').onclick=()=>{camera.getTracks().forEach(t=>t.stop());modal.remove()}}catch(e){alert('Izinkan akses kamera di browser.')}};
</script></body></html>
