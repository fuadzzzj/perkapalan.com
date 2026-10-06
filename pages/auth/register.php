<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}

require APP_ROOT . '/service/database.php';
session_start();

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] === true) {
    header('Location: index.php?route=dashboard');
    exit;
}

$register_message = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
    $kelas = trim($_POST['kelas'] ?? '');
    $nis = trim($_POST['nis'] ?? '');
    $jurusan = trim($_POST['jurusan'] ?? 'Teknik Perkapalan');
    $tahun_masuk = (int) ($_POST['tahun_masuk'] ?? date('Y'));

    if ($username === '' || $password === '' || $nama_lengkap === '' || $kelas === '' || $nis === '') {
      $register_message = 'Data akun dan profil wajib diisi.';
    } else {
        try {
        $stmt = $db->prepare('INSERT INTO user (username, password, nama_lengkap, kelas, nis, jurusan, tahun_masuk) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ssssssi', $username, $passwordHash, $nama_lengkap, $kelas, $nis, $jurusan, $tahun_masuk);

            if ($stmt->execute()) {
                $register_message = 'Daftar akun berhasil, silakan login.';
            } else {
                $register_message = 'Daftar akun gagal, silakan coba lagi.';
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            $register_message = 'Username sudah digunakan.';
        }
    }
}
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Form Pengumpulan Laporan Praktikum - SMK Perkapalan Al-Zaytun">
  <title>Login | SMK Perkapalan Al-Zaytun</title>
  <link rel="stylesheet" href="format_css/login.css">
</head>
<body>
  <div class="login-root">
    <div class="stars" id="stars"></div>

    <svg class="ocean-bg" viewBox="0 0 800 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0,80 C100,40 200,120 300,80 C400,40 500,120 600,80 C700,40 800,100 800,80 L800,200 L0,200 Z" fill="#2A6B8A"/>
      <path d="M0,120 C80,90 180,150 280,110 C380,70 480,140 580,100 C680,60 760,130 800,100 L800,200 L0,200 Z" fill="#1A4A6A" opacity="0.8"/>
      <path d="M0,150 C120,120 220,165 340,140 C460,115 560,155 680,135 C740,125 780,145 800,140 L800,200 L0,200 Z" fill="#0F2F4A" opacity="0.9"/>
    </svg>

    <svg class="compass" width="80" height="80" viewBox="0 0 80 80">
      <circle cx="40" cy="40" r="36" fill="none" stroke="#C9A84C" stroke-width="0.5"/>
      <circle cx="40" cy="40" r="28" fill="none" stroke="#C9A84C" stroke-width="0.3" stroke-dasharray="2 4"/>
      <line x1="40" y1="8" x2="40" y2="20" stroke="#C9A84C" stroke-width="1"/>
      <line x1="40" y1="60" x2="40" y2="72" stroke="#C9A84C" stroke-width="0.5"/>
      <line x1="8" y1="40" x2="20" y2="40" stroke="#C9A84C" stroke-width="0.5"/>
      <line x1="60" y1="40" x2="72" y2="40" stroke="#C9A84C" stroke-width="0.5"/>
      <text x="40" y="6" text-anchor="middle" fill="#C9A84C" font-size="7" font-family="Inter,sans-serif" font-weight="500">U</text>
      <text x="40" y="78" text-anchor="middle" fill="#C9A84C" font-size="7" font-family="Inter,sans-serif">S</text>
      <text x="76" y="43" text-anchor="middle" fill="#C9A84C" font-size="7" font-family="Inter,sans-serif">T</text>
      <text x="4" y="43" text-anchor="middle" fill="#C9A84C" font-size="7" font-family="Inter,sans-serif">B</text>
      <polygon points="40,16 43,38 40,34 37,38" fill="#C9A84C"/>
      <polygon points="40,64 43,42 40,46 37,42" fill="#C9A84C" opacity="0.4"/>
    </svg>

    <div class="card">
        <div class="rapihin">
        <button class="tombol-beranda" type="submit" onclick="window.location.href='index.php?route=beranda'">Beranda</button>
        <button class="tombol-beranda" type="submit" onclick="window.location.href='index.php?route=halaman_login'">Login</button>
        </div>
      <div class="brand-row">
        <div class="ship-wrap">
          <svg width="110" height="68" viewBox="0 0 110 68" xmlns="http://www.w3.org/2000/svg">
            <line x1="55" y1="4" x2="55" y2="54" stroke="#C9A84C" stroke-width="1" opacity="0.7"/>
            <polygon points="55,6 55,28 32,28" fill="none" stroke="#F5F0E8" stroke-width="0.8" opacity="0.5"/>
            <polygon points="55,6 55,32 72,32" fill="none" stroke="#F5F0E8" stroke-width="0.6" opacity="0.35"/>
            <path d="M20,54 Q35,48 55,48 Q75,48 90,54 L86,60 Q70,56 55,56 Q40,56 24,60 Z" fill="none" stroke="#C9A84C" stroke-width="1" opacity="0.8"/>
            <path d="M24,60 Q40,57 55,57 Q70,57 86,60 L82,65 Q68,62 55,62 Q42,62 28,65 Z" fill="rgba(42,107,138,0.4)" stroke="#2A6B8A" stroke-width="0.5"/>
            <line x1="8" y1="62" x2="102" y2="62" stroke="#2A6B8A" stroke-width="1" opacity="0.5"/>
            <path d="M4,62 Q55,54 106,62" fill="none" stroke="rgba(42,107,138,0.3)" stroke-width="1"/>
          </svg>
        </div>
        <div class="brand-name">Al-Zaytun</div>
        <div class="brand-sub">Perkapalan &amp; Pelayaran</div>
      </div>

      <div class="divider">
        <div class="divider-line"></div>
        <div class="divider-diamond"></div>
        <div class="divider-line"></div>
      </div>

      <?php if (!empty($register_message)) : ?>
        <p style="margin: 0 0 12px; color: #ff6b6b; font-weight: 600;"><?php echo htmlspecialchars($register_message, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php endif; ?>

      <form action="index.php?route=register" method="POST">
        <div class="field-group">
          <label class="field-label" for="nama_lengkap">Nama Lengkap</label>
          <div class="field-wrap"><input class="field-input" id="nama_lengkap" type="text" placeholder="Nama lengkap anggota" name="nama_lengkap" required></div>
        </div>
        <div class="field-group">
          <label class="field-label" for="kelas">Kelas</label>
          <div class="field-wrap"><input class="field-input" id="kelas" type="text" placeholder="Contoh: XI Perkapalan B" name="kelas" required></div>
        </div>
        <div class="field-group">
          <label class="field-label" for="nis">NIS</label>
          <div class="field-wrap"><input class="field-input" id="nis" type="text" placeholder="Nomor induk siswa" name="nis" required></div>
        </div>
        <div class="field-group">
          <label class="field-label" for="username">Nama Pengguna</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            <input class="field-input" id="username" type="text" placeholder="Masukkan nama pengguna" name="username" autocomplete="username" required>
          </div>
        </div>

        <div class="field-group">
          <label class="field-label" for="password">Kata Sandi</label>
          <div class="field-wrap">
            <svg class="field-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
              <rect x="3" y="11" width="18" height="11" rx="2"/>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
            <input class="field-input" id="password" type="password" placeholder="Masukkan kata sandi" name="password" autocomplete="current-password" required>
          </div>
          <i style="color: #e7e70ad6;"><?php echo htmlspecialchars($register_message, ENT_QUOTES, 'UTF-8'); ?></i>
        </div>
        <button class="btn-login" type="submit" name="register">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path d="M12 2L8 6h3v8h2V6h3z"/>
            <path d="M4 14v4a2 2 0 002 2h12a2 2 0 002-2v-4"/>
          </svg>
          register
        </button>
      </form>

      <p class="footer-note">2025 PT Al-Zaytun Perkapalan DB 23</p>
    </div>
  </div>

  <script>
    const starsEl = document.getElementById('stars');
    if (starsEl) {
      for (let i = 0; i < 55; i++) {
        const s = document.createElement('div');
        s.className = 'star';
        s.style.left = Math.random() * 100 + '%';
        s.style.top = Math.random() * 100 + '%';
        s.style.opacity = (0.2 + Math.random() * 0.6).toFixed(2);
        s.style.width = s.style.height = (Math.random() > 0.7 ? 3 : 2) + 'px';
        starsEl.appendChild(s);
      }
    }
  </script>
</body>
</html>