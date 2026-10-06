<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}

require APP_ROOT . '/service/database.php';
session_start();
if (empty($_SESSION['is_login'])) { header('Location: index.php?route=halaman_login'); exit; }
$userId = (int) $_SESSION['user_id'];
$page = $_GET['page'] ?? 'jadwal';
$allowed = ['upload', 'jadwal', 'pengumuman', 'nilai', 'profil'];
if (!in_array($page, $allowed, true)) $page = 'jadwal';
$escape = static fn($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'upload') {
    $title = trim($_POST['judul'] ?? ''); $file = $_FILES['file_laporan'] ?? null;
    $type = $file ? (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']) : '';
    $valid = ['application/pdf', 'application/zip', 'application/x-rar', 'application/vnd.rar'];
    if (!$file || $file['error'] !== UPLOAD_ERR_OK || $title === '') $message = 'Judul dan file laporan wajib diisi.';
    elseif ($file['size'] > 10 * 1024 * 1024 || !in_array($type, $valid, true)) $message = 'File harus PDF, ZIP, atau RAR dan maksimal 10 MB.';
    else {
        $folder = APP_ROOT . '/uploads/laporan'; if (!is_dir($folder)) mkdir($folder, 0755, true);
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)); $stored = bin2hex(random_bytes(12)) . '.' . $ext;
        if (move_uploaded_file($file['tmp_name'], $folder . '/' . $stored)) { $path = 'uploads/laporan/' . $stored; $date = date('Y-m-d'); $status = 'menunggu'; $stmt = $db->prepare('INSERT INTO laporan (user_id, judul, status, tanggal_kirim, file_path) VALUES (?, ?, ?, ?, ?)'); $stmt->bind_param('issss', $userId, $title, $status, $date, $path); $stmt->execute(); $stmt->close(); $message = 'Laporan berhasil dikirim ke guru.'; }
    }
}
$memberStmt = $db->prepare('SELECT nama_lengkap, username, kelas, nis, jurusan FROM user WHERE id = ?'); $memberStmt->bind_param('i', $userId); $memberStmt->execute(); $member = $memberStmt->get_result()->fetch_assoc(); $memberStmt->close();
if ($page === 'jadwal') { $rows = $db->query('SELECT mata_pelajaran, tanggal, jam, ruang, foto_path FROM jadwal_praktikum ORDER BY tanggal ASC, jam ASC'); $announcements = $db->query('SELECT p.judul, p.isi, p.created_at, u.nama_lengkap FROM pengumuman p JOIN user u ON u.id=p.dibuat_oleh ORDER BY p.created_at DESC LIMIT 8'); }
elseif ($page === 'pengumuman') $rows = $db->query('SELECT p.judul, p.isi, p.created_at, u.nama_lengkap FROM pengumuman p JOIN user u ON u.id=p.dibuat_oleh ORDER BY p.created_at DESC');
elseif ($page === 'nilai') { $stmt = $db->prepare('SELECT mata_pelajaran, nilai, semester FROM nilai_praktikum WHERE user_id=? ORDER BY mata_pelajaran'); $stmt->bind_param('i', $userId); $stmt->execute(); $rows = $stmt->get_result(); $stmt->close(); }
else { $stmt = $db->prepare('SELECT judul, status, tanggal_kirim, file_path FROM laporan WHERE user_id=? ORDER BY tanggal_kirim DESC'); $stmt->bind_param('i', $userId); $stmt->execute(); $rows = $stmt->get_result(); $stmt->close(); }
$labels = ['upload'=>'Upload Laporan','jadwal'=>'Jadwal & Pengumuman','pengumuman'=>'Jadwal & Pengumuman','nilai'=>'Nilai Saya','profil'=>'Profil Saya'];
?><!doctype html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?php echo $labels[$page]; ?> | Perkapalan</title><link rel="stylesheet" href="format_css/portal.css"></head><body><main class="portal"><header><div><span>PORTAL PELAJAR</span><h1><?php echo $labels[$page]; ?></h1><p>Halo, <?php echo $escape($member['nama_lengkap']); ?>. Semua kebutuhan praktikmu ada di sini.</p></div><a href="index.php?route=dashboard">Dashboard</a></header><nav><a href="index.php?route=portal_pelajar&amp;page=upload">Upload Laporan</a><a href="index.php?route=portal_pelajar&amp;page=jadwal">Jadwal</a><a href="index.php?route=portal_pelajar&amp;page=nilai">Nilai Saya</a><a href="index.php?route=portal_pelajar&amp;page=pengumuman">Pengumuman</a><a href="index.php?route=portal_pelajar&amp;page=profil">Profil</a><a href="index.php?route=chat">Chat Grup</a></nav><section class="content"><?php if($message): ?><div class="notice"><?php echo $escape($message); ?></div><?php endif; ?><?php if($page === 'upload'): ?><div class="intro"><h2>Kirim hasil praktik dengan rapi</h2><p>Guru dapat langsung membuka file yang kamu kirim dari panel pemeriksaan laporan.</p></div><form class="form" method="post" enctype="multipart/form-data"><label>Judul laporan<input name="judul" required placeholder="Contoh: Perawatan Mesin Kapal"></label><label>File laporan<input type="file" name="file_laporan" accept=".pdf,.zip,.rar" required></label><small>PDF, ZIP, atau RAR, maksimal 10 MB.</small><button type="submit">Kirim laporan</button></form><?php elseif($page === 'profil'): ?><div class="profile"><h2><?php echo $escape($member['nama_lengkap']); ?></h2><p>Username: <?php echo $escape($member['username']); ?> · <?php echo $escape($member['kelas']); ?> · NIS <?php echo $escape($member['nis']); ?></p><h3>Riwayat laporan</h3><?php while($row=$rows->fetch_assoc()): ?><article><b><?php echo $escape($row['judul']); ?></b><span><?php echo $escape($row['status'].' · '.$row['tanggal_kirim']); ?> <?php if($row['file_path']): ?><a class="file-link" href="<?php echo $escape($row['file_path']); ?>" target="_blank">Buka file</a><?php endif; ?></span></article><?php endwhile; ?></div><?php else: ?><div class="list"><?php while($row=$rows->fetch_assoc()): ?><article><?php if($page==='jadwal'): ?><b><?php echo $escape($row['mata_pelajaran']); ?></b><span><?php echo $escape($row['tanggal'].' · '.$row['jam'].' · '.$row['ruang']); ?></span><?php if($row['foto_path']): ?><img class="schedule-photo" src="<?php echo $escape($row['foto_path']); ?>" alt="Foto jadwal <?php echo $escape($row['mata_pelajaran']); ?>"><?php endif; ?><?php elseif($page==='pengumuman'): ?><b><?php echo $escape($row['judul']); ?></b><span>Oleh <?php echo $escape($row['nama_lengkap']); ?> · <?php echo $escape($row['created_at']); ?></span><p><?php echo nl2br($escape($row['isi'])); ?></p><?php else: ?><b><?php echo $escape($row['mata_pelajaran']); ?></b><span><?php echo number_format((float)$row['nilai'],1).' · '.$escape($row['semester']); ?></span><?php endif; ?></article><?php endwhile; if($rows->num_rows===0): ?><p>Belum ada data.</p><?php endif; ?></div><?php endif; ?></section></main></body></html>
