<?php
require __DIR__ . '/service/database.php';
session_start();

if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== true) {
    header('Location: halaman_login.php');
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: halaman_login.php');
    exit;
}

$userId = (int) ($_SESSION['user_id'] ?? 0);
$stmt = $db->prepare('SELECT nama_lengkap, kelas, nis, jurusan, tahun_masuk FROM user WHERE id = ? LIMIT 1');
$stmt->bind_param('i', $userId);
$stmt->execute();
$member = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$member) {
  session_unset();
  session_destroy();
  header('Location: halaman_login.php');
  exit;
}

$stmt = $db->prepare("SELECT COUNT(*) AS total, SUM(status = 'disetujui') AS disetujui, SUM(status = 'revisi') AS revisi FROM laporan WHERE user_id = ?");
$stmt->bind_param('i', $userId);
$stmt->execute();
$reportStats = $stmt->get_result()->fetch_assoc();
$stmt->close();

$stmt = $db->prepare('SELECT COALESCE(AVG(nilai), 0) AS rata_rata FROM nilai_praktikum WHERE user_id = ?');
$stmt->bind_param('i', $userId);
$stmt->execute();
$averageScore = (float) $stmt->get_result()->fetch_assoc()['rata_rata'];
$stmt->close();

$stmt = $db->prepare('SELECT judul, status, tanggal_kirim FROM laporan WHERE user_id = ? ORDER BY tanggal_kirim DESC LIMIT 3');
$stmt->bind_param('i', $userId);
$stmt->execute();
$reports = $stmt->get_result();
$stmt->close();

$stmt = $db->prepare('SELECT mata_pelajaran, nilai FROM nilai_praktikum WHERE user_id = ? ORDER BY mata_pelajaran');
$stmt->bind_param('i', $userId);
$stmt->execute();
$scores = $stmt->get_result();
$scoreRows = $scores->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$initial = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $member['nama_lengkap']), 0, 2));
$escape = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Dashboard Taruna - SMK Perkapalan Al-Zaytun">
  <title>Dashboard Taruna | SMK Perkapalan Al-Zaytun</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="format_css/dashboard_taruna.css">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
</head>
<body>
  <!-- SIDEBAR -->
  <nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="anchor-icon">⚓</div>
      <h1>SMK Perkapalan<br>Al-Zaytun</h1>
      <p>Portal Taruna</p>
    </div>

    <div class="sidebar-nav">
      <span class="nav-section-label">Utama</span>
      <a class="nav-item active" href="dashboard.php">
        <i data-lucide="grid" style="width:16px;height:16px;"></i>
        Dashboard
      </a>
      <a class="nav-item" href="portal_pelajar.php?page=profil">
        <i data-lucide="file-text" style="width:16px;height:16px;"></i>
        Praktikum Saya
      </a>
      <a class="nav-item" href="portal_pelajar.php?page=upload">
        <i data-lucide="upload" style="width:16px;height:16px;"></i>
        Upload Laporan
      </a>
      <a class="nav-item" href="portal_utama.php">
        <i data-lucide="calendar" style="width:16px;height:16px;"></i>
        Jadwal Praktikum
      </a>

      <span class="nav-section-label" style="margin-top:20px;">Akademik</span>
      <a class="nav-item" href="portal_pelajar.php?page=nilai">
        <i data-lucide="bar-chart-2" style="width:16px;height:16px;"></i>
        Nilai Praktikum
      </a>
      <a class="nav-item" href="portal_utama.php">
        <i data-lucide="anchor" style="width:16px;height:16px;"></i>
        Progress Kapal
      </a>

      <span class="nav-section-label" style="margin-top:20px;">Lainnya</span>
      <a class="nav-item" href="portal_pelajar.php?page=jadwal">
        <i data-lucide="bell" style="width:16px;height:16px;"></i>
        Jadwal & Pengumuman
      </a>
      <a class="nav-item" href="portal_pelajar.php?page=profil">
        <i data-lucide="user" style="width:16px;height:16px;"></i>
        Profil Saya
      </a>
      <a class="nav-item" href="chat.php">
        <i data-lucide="messages-square" style="width:16px;height:16px;"></i>
        Ruang Chat
      </a>
    </div>

    <div class="sidebar-user">
      <div class="user-avatar"><?php echo $escape($initial); ?></div>
      <div class="user-info">
        <div class="name"><?php echo $escape($member['nama_lengkap']); ?></div>
        <div class="rank"><?php echo $escape($member['kelas']); ?> · <?php echo $escape($member['tahun_masuk']); ?></div>
      </div>
    </div>
  </nav>

  <!-- MAIN -->
  <div class="main">
    <!-- TOPBAR -->
    <header class="topbar">
      <div class="topbar-left">
        <h2>Dashboard Taruna</h2>
        <p><?php echo $escape(strftime('%A, %d %B %Y')); ?> · Semester Genap</p>
      </div>
      <div class="topbar-right">
        <button class="logout-btn" onclick="logout()">Keluar</button>
      </div>
    </header>

    <!-- CONTENT -->
    <div class="content">
      <!-- PROFIL HERO -->
      <div class="hero-profile">
        <div class="profile-photo"><?php echo $escape($initial); ?></div>
        <div class="profile-info">
          <div class="label">Taruna Aktif</div>
          <h2><?php echo $escape($member['nama_lengkap']); ?></h2>
          <div class="profile-meta">
            <div class="profile-meta-item">
              <i data-lucide="book" style="width:13px;height:13px;color:#4a9fd4;"></i>
              <span>Kelas <strong><?php echo $escape($member['kelas']); ?></strong></span>
            </div>
            <div class="profile-meta-item">
              <i data-lucide="id-card" style="width:13px;height:13px;color:#4a9fd4;"></i>
              <span>NIS <strong><?php echo $escape($member['nis']); ?></strong></span>
            </div>
            <div class="profile-meta-item">
              <i data-lucide="briefcase" style="width:13px;height:13px;color:#4a9fd4;"></i>
              <span>Jurusan <strong><?php echo $escape($member['jurusan']); ?></strong></span>
            </div>
          </div>
        </div>
      </div>

      <!-- STATS -->
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon" style="background:var(--sea-pale);">
            <i data-lucide="file-text" style="width:17px;height:17px;color:#1c6ea4;"></i>
          </div>
          <div class="stat-value"><?php echo (int) ($reportStats['total'] ?? 0); ?></div>
          <div class="stat-label">Laporan Dikirim</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:var(--success-pale);">
            <i data-lucide="check-circle" style="width:17px;height:17px;color:#1a7a4a;"></i>
          </div>
          <div class="stat-value"><?php echo (int) ($reportStats['disetujui'] ?? 0); ?></div>
          <div class="stat-label">Laporan Disetujui</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:var(--warn-pale);">
            <i data-lucide="alert-circle" style="width:17px;height:17px;color:#b05e00;"></i>
          </div>
          <div class="stat-value"><?php echo (int) ($reportStats['revisi'] ?? 0); ?></div>
          <div class="stat-label">Menunggu Revisi</div>
        </div>

        <div class="stat-card">
          <div class="stat-icon" style="background:var(--gold-pale);">
            <i data-lucide="star" style="width:17px;height:17px;color:#c9922b;"></i>
          </div>
          <div class="stat-value"><?php echo number_format($averageScore, 1); ?></div>
          <div class="stat-label">Rata-rata Nilai</div>
        </div>
      </div>

      <!-- GRID -->
      <div class="grid-2">
        <!-- PRAKTIKUM SAYA -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <i data-lucide="clipboard-list" style="width:16px;height:16px;"></i>
              <h3>Praktikum Terakhir</h3>
            </div>
          </div>
          <div class="laporan-list">
            <?php while ($report = $reports->fetch_assoc()) : ?>
            <div class="laporan-item">
              <div class="laporan-left">
                <div class="laporan-icon">
                  <i data-lucide="file-pdf" style="width:15px;height:15px;"></i>
                </div>
                <div>
                  <div class="laporan-name"><?php echo $escape($report['judul']); ?></div>
                  <div class="laporan-date"><?php echo $escape(date('d M Y', strtotime($report['tanggal_kirim']))); ?></div>
                </div>
              </div>
              <span class="status status-<?php echo $report['status'] === 'disetujui' ? 'ok' : ($report['status'] === 'revisi' ? 'revisi' : 'wait'); ?>">
                <?php echo $report['status'] === 'disetujui' ? '✓ Disetujui' : ($report['status'] === 'revisi' ? '✕ Revisi' : '⏳ Menunggu'); ?>
              </span>
            </div>
            <?php endwhile; ?>
            <?php if ($reports->num_rows === 0) : ?>
              <p class="empty-state">Belum ada laporan praktikum.</p>
            <?php endif; ?>
          </div>
        </div>

        <!-- NILAI PRAKTIKUM -->
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <i data-lucide="bar-chart-2" style="width:16px;height:16px;"></i>
              <h3>Nilai Praktikum</h3>
            </div>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
            <?php foreach ($scoreRows as $score) : ?>
            <div style="background:var(--fog);border-radius:8px;padding:11px 13px;display:flex;align-items:center;justify-content:space-between;">
              <div style="font-size:11px;color:var(--ink-mid);font-weight:500;"><?php echo $escape($score['mata_pelajaran']); ?></div>
              <div style="font-size:18px;font-weight:700;color:#1a7a4a;"><?php echo number_format((float) $score['nilai'], 1); ?></div>
          </div>
            <?php endforeach; ?>
            <?php if (!$scoreRows) : ?><p class="empty-state">Belum ada nilai praktikum.</p><?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <script>
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }

    function logout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'dashboard.php';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'logout';
        input.value = '1';

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>
</body>
</html>
