<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}

require APP_ROOT . '/service/database.php';
session_start();
if (empty($_SESSION['is_login'])) { header('Location: index.php?route=halaman_login'); exit; }
$userId = (int) $_SESSION['user_id'];
$page = $_GET['page'] ?? 'pengumuman';
$allowed = ['upload', 'jadwal', 'pengumuman', 'nilai', 'profil'];
if (!in_array($page, $allowed, true)) $page = 'pengumuman';
$escape = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'upload') {
    $title = trim($_POST['judul'] ?? ''); $file = $_FILES['file_laporan'] ?? null;
    $validTypes = ['application/pdf', 'application/zip', 'application/x-rar-compressed'];
    if ($title === '' || !$file || $file['error'] !== UPLOAD_ERR_OK) $message = 'Judul dan file laporan wajib diisi.';
    elseif ($file['size'] > 10 * 1024 * 1024 || !in_array($file['type'], $validTypes, true)) $message = 'File harus PDF/ZIP/RAR dan maksimal 10 MB.';
    else {
        $folder = APP_ROOT . '/uploads/laporan'; if (!is_dir($folder)) mkdir($folder, 0755, true);
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)); $storedName = bin2hex(random_bytes(12)) . '.' . $extension;
        if (move_uploaded_file($file['tmp_name'], $folder . '/' . $storedName)) {
            $date = date('Y-m-d'); $status = 'menunggu'; $path = 'uploads/laporan/' . $storedName;
            $stmt = $db->prepare('INSERT INTO laporan (user_id, judul, status, tanggal_kirim, file_path) VALUES (?, ?, ?, ?, ?)'); $stmt->bind_param('issss', $userId, $title, $status, $date, $path); $stmt->execute(); $stmt->close(); $message = 'Laporan berhasil dikirim.';
        } else $message = 'File gagal disimpan.';
    }
}
$memberStmt = $db->prepare('SELECT nama_lengkap, username, kelas, nis, jurusan, tahun_masuk FROM user WHERE id = ?'); $memberStmt->bind_param('i', $userId); $memberStmt->execute(); $member = $memberStmt->get_result()->fetch_assoc(); $memberStmt->close();
$rows = [];
if ($page === 'jadwal') $rows = $db->query('SELECT mata_pelajaran, tanggal, jam, ruang, foto_path FROM jadwal_praktikum ORDER BY tanggal ASC, jam ASC');
if ($page === 'pengumuman') $rows = $db->query('SELECT p.judul, p.isi, p.created_at, u.nama_lengkap FROM pengumuman p JOIN user u ON u.id=p.dibuat_oleh ORDER BY p.created_at DESC');
if ($page === 'nilai') { $stmt=$db->prepare('SELECT mata_pelajaran, nilai, semester FROM nilai_praktikum WHERE user_id=? ORDER BY mata_pelajaran'); $stmt->bind_param('i',$userId); $stmt->execute(); $rows=$stmt->get_result(); $stmt->close(); }
if ($page === 'profil') $rows = $db->query('SELECT judul, status, tanggal_kirim, file_path FROM laporan WHERE user_id=' . $userId . ' ORDER BY tanggal_kirim DESC');
$titleMap = ['upload'=>'Upload Laporan','jadwal'=>'Jadwal Praktikum','pengumuman'=>'Pengumuman','nilai'=>'Nilai Praktikum','profil'=>'Profil Saya'];
?><!doctype html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?php echo $titleMap[$page]; ?> | Perkapalan</title><link rel="stylesheet" href="format_css/portal.css"></head><body><main class="portal"><header><div><span>PORTAL PELAJAR</span><h1><?php echo $titleMap[$page]; ?></h1></div><a href="index.php?route=dashboard">Dashboard</a></header><nav><a href="index.php?route=fitur_pelajar&amp;page=upload">Upload Laporan</a><a href="index.php?route=fitur_pelajar&amp;page=jadwal">Jadwal</a><a href="index.php?route=fitur_pelajar&amp;page=nilai">Nilai Saya</a><a href="index.php?route=fitur_pelajar&amp;page=pengumuman">Pengumuman</a><a href="index.php?route=fitur_pelajar&amp;page=profil">Profil</a><a href="index.php?route=chat">Chat Grup</a></nav><section class="content"><?php if($message): ?><div class="notice"><?php echo $escape($message); ?></div><?php endif; ?><?php if($page==='upload'): ?><form class="form" method="post" enctype="multipart/form-data"><label>Judul laporan<input name="judul" required placeholder="Contoh: Perawatan Mesin Kapal"></label><label>File laporan<input type="file" name="file_laporan" accept=".pdf,.zip,.rar" required></label><small>Format PDF, ZIP, atau RAR, maksimal 10 MB.</small><button type="submit">Kirim laporan</button></form><?php elseif($page==='profil'): ?><div class="profile"><h2><?php echo $escape($member['nama_lengkap']); ?></h2><p>Username: <?php echo $escape($member['username']); ?></p><p>Kelas: <?php echo $escape($member['kelas']); ?></p><p>NIS: <?php echo $escape($member['nis']); ?></p><p>Jurusan: <?php echo $escape($member['jurusan']); ?></p><h3>Riwayat laporan</h3><?php while($row=$rows->fetch_assoc()): ?><article><b><?php echo $escape($row['judul']); ?></b><span><?php echo $escape($row['status'].' · '.$row['tanggal_kirim']); ?> <?php if($row['file_path']): ?><a href="<?php echo $escape($row['file_path']); ?>" target="_blank">Lihat file</a><?php endif; ?></span></article><?php endwhile; ?></div><?php else: ?><div class="list"><?php while($row=$rows->fetch_assoc()): ?><article><?php if($page==='pengumuman'): ?><b><?php echo $escape($row['judul']); ?></b><span>Oleh <?php echo $escape($row['nama_lengkap']); ?> · <?php echo $escape($row['created_at']); ?></span><p><?php echo nl2br($escape($row['isi'])); ?></p><?php elseif($page==='jadwal'): ?><b><?php echo $escape($row['mata_pelajaran']); ?></b><span><?php echo $escape($row['tanggal'].' · '.$row['jam'].' · '.$row['ruang']); ?></span><?php else: ?><b><?php echo $escape($row['mata_pelajaran']); ?></b><span><?php echo number_format((float)$row['nilai'],1).' · '.$escape($row['semester']); ?></span><?php endif; ?></article><?php endwhile; if($rows->num_rows===0): ?><p>Belum ada data.</p><?php endif; ?></div><?php endif; ?></section></main></body></html>
