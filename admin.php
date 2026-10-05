<?php
require __DIR__ . '/service/database.php';
session_start();
if (empty($_SESSION['is_login']) || ($_SESSION['role'] ?? '') !== 'guru') {
    header('Location: halaman_login.php'); exit;
}
$teacherId = (int) $_SESSION['user_id'];
$escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'nilai') {
        $studentId = (int) $_POST['user_id']; $subject = trim($_POST['mata_pelajaran'] ?? ''); $score = (float) $_POST['nilai'];
        $stmt = $db->prepare('INSERT INTO nilai_praktikum (user_id, mata_pelajaran, nilai, semester) VALUES (?, ?, ?, ?)');
        $semester = 'Genap'; $stmt->bind_param('isds', $studentId, $subject, $score, $semester); $stmt->execute(); $stmt->close(); $message = 'Nilai berhasil disimpan.';
    } elseif ($action === 'laporan') {
        $reportId = (int) $_POST['laporan_id']; $status = $_POST['status'] ?? 'menunggu';
        if (in_array($status, ['menunggu', 'disetujui', 'revisi'], true)) { $stmt = $db->prepare('UPDATE laporan SET status = ? WHERE id = ?'); $stmt->bind_param('si', $status, $reportId); $stmt->execute(); $stmt->close(); $message = 'Status laporan diperbarui.'; }
    } elseif ($action === 'jadwal') {
        $subject = trim($_POST['mata_pelajaran']); $date = $_POST['tanggal']; $time = $_POST['jam']; $room = trim($_POST['ruang']); $photo = $_FILES['foto_jadwal'] ?? null;
        $photoPath = null;
        if ($photo && $photo['error'] === UPLOAD_ERR_OK) {
            $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
            $detectedType = (new finfo(FILEINFO_MIME_TYPE))->file($photo['tmp_name']);
            if (!isset($allowedTypes[$detectedType]) || $photo['size'] > 8 * 1024 * 1024) { $message = 'Foto harus JPG, PNG, atau WEBP dan maksimal 8 MB.'; }
            else { $folder = __DIR__ . '/uploads/jadwal'; if (!is_dir($folder)) mkdir($folder, 0755, true); $stored = bin2hex(random_bytes(12)) . '.' . $allowedTypes[$detectedType]; if (move_uploaded_file($photo['tmp_name'], $folder . '/' . $stored)) $photoPath = 'uploads/jadwal/' . $stored; }
        }
        if ($message === '') { $stmt = $db->prepare('INSERT INTO jadwal_praktikum (mata_pelajaran, tanggal, jam, ruang, foto_path, dibuat_oleh) VALUES (?, ?, ?, ?, ?, ?)'); $stmt->bind_param('sssssi', $subject, $date, $time, $room, $photoPath, $teacherId); $stmt->execute(); $stmt->close(); $message = 'Jadwal berhasil ditambahkan.'; }
    } elseif ($action === 'pengumuman') {
        $title = trim($_POST['judul']); $body = trim($_POST['isi']);
        $stmt = $db->prepare('INSERT INTO pengumuman (judul, isi, dibuat_oleh) VALUES (?, ?, ?)'); $stmt->bind_param('ssi', $title, $body, $teacherId); $stmt->execute(); $stmt->close(); $message = 'Pengumuman berhasil diterbitkan.';
    }
}
$students = $db->query("SELECT id, nama_lengkap, kelas, nis FROM user WHERE role = 'siswa' ORDER BY nama_lengkap");
$reports = $db->query('SELECT l.id, l.judul, l.status, l.tanggal_kirim, l.file_path, u.nama_lengkap, u.kelas FROM laporan l JOIN user u ON u.id = l.user_id ORDER BY l.tanggal_kirim DESC');
$recentSchedules = $db->query('SELECT mata_pelajaran, tanggal, jam, ruang, foto_path FROM jadwal_praktikum ORDER BY tanggal DESC, jam DESC LIMIT 8');
$recentAnnouncements = $db->query('SELECT judul, isi, created_at FROM pengumuman ORDER BY created_at DESC LIMIT 5');
?>
<!doctype html><html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Panel Guru | Perkapalan</title><link rel="stylesheet" href="format_css/admin.css"></head><body>
<header class="topbar"><div><span class="eyebrow">Portal Pengajar</span><h1>Ruang kendali akademik</h1></div><div class="actions"><a class="button" href="chat.php">Ruang chat</a><a class="button danger" href="dashboard.php">Kembali</a></div></header>
<main class="page"><?php if ($message): ?><div class="notice"><?php echo $escape($message); ?></div><?php endif; ?>
<section class="stats"><div><b><?php echo $students->num_rows; ?></b><span>Pelajar terdaftar</span></div><div><b><?php echo $reports->num_rows; ?></b><span>Laporan masuk</span></div><div><b><?php echo $recentSchedules->num_rows; ?></b><span>Jadwal aktif</span></div></section>
<div class="columns"><section class="panel"><div class="panel-title"><h2>Masukkan nilai</h2><span>Nilai akan langsung masuk ke dashboard pelajar.</span></div><form method="post" class="form"><input type="hidden" name="action" value="nilai"><label>Pelajar<select name="user_id" required><?php while($student=$students->fetch_assoc()): ?><option value="<?php echo (int)$student['id']; ?>"><?php echo $escape($student['nama_lengkap'].' · '.$student['kelas'].' · '.$student['nis']); ?></option><?php endwhile; ?></select></label><label>Mata pelajaran<input name="mata_pelajaran" placeholder="Contoh: Mesin Kapal" required></label><label>Nilai<input name="nilai" type="number" min="0" max="100" step="0.01" required></label><button class="button" type="submit">Simpan nilai</button></form></section>
<section class="panel"><div class="panel-title"><h2>Jadwal praktikum</h2><span>Publikasikan jadwal untuk semua pelajar.</span></div><form method="post" enctype="multipart/form-data" class="form"><input type="hidden" name="action" value="jadwal"><label>Mata pelajaran<input name="mata_pelajaran" required></label><div class="form-row"><label>Tanggal<input name="tanggal" type="date" required></label><label>Jam<input name="jam" type="time" required></label></div><label>Ruang<input name="ruang" placeholder="Lab Perkapalan" required></label><label>Foto jadwal<input name="foto_jadwal" type="file" accept=".jpg,.jpeg,.png,.webp"></label><button class="button" type="submit">Tambah jadwal</button></form><div class="mini-list"><?php while($row=$recentSchedules->fetch_assoc()): ?><p><b><?php echo $escape($row['mata_pelajaran']); ?></b><span><?php echo $escape($row['tanggal'].' · '.$row['jam'].' · '.$row['ruang']); ?></span><?php if($row['foto_path']): ?><a href="<?php echo $escape($row['foto_path']); ?>" target="_blank">Lihat foto</a><?php endif; ?></p><?php endwhile; ?></div></section>
<section class="panel"><div class="panel-title"><h2>Pengumuman</h2><span>Pesan ini terlihat oleh seluruh pelajar.</span></div><form method="post" class="form"><input type="hidden" name="action" value="pengumuman"><label>Judul<input name="judul" required></label><label>Isi<textarea name="isi" rows="4" required></textarea></label><button class="button" type="submit">Terbitkan</button></form><div class="mini-list"><?php while($row=$recentAnnouncements->fetch_assoc()): ?><p><b><?php echo $escape($row['judul']); ?></b><span><?php echo $escape($row['isi']); ?></span></p><?php endwhile; ?></div></section></div>
<section class="panel reports"><div class="panel-title"><h2>Pemeriksaan laporan pelajar</h2><span>Unduh file sebelum mengubah status.</span></div><?php while($report=$reports->fetch_assoc()): ?><div class="report"><div><b><?php echo $escape($report['judul']); ?></b><span><?php echo $escape($report['nama_lengkap'].' · '.$report['kelas'].' · '.$report['tanggal_kirim']); ?></span><?php if($report['file_path']): ?><a class="file-link" href="<?php echo $escape($report['file_path']); ?>" target="_blank" download>Buka file laporan</a><?php else: ?><span>File belum tersedia</span><?php endif; ?></div><form method="post"><input type="hidden" name="action" value="laporan"><input type="hidden" name="laporan_id" value="<?php echo (int)$report['id']; ?>"><select name="status"><option value="menunggu" <?php echo $report['status']==='menunggu'?'selected':''; ?>>Menunggu</option><option value="disetujui" <?php echo $report['status']==='disetujui'?'selected':''; ?>>Disetujui</option><option value="revisi" <?php echo $report['status']==='revisi'?'selected':''; ?>>Revisi</option></select><button class="button small" type="submit">Perbarui</button></form></div><?php endwhile; ?></section></main></body></html>
