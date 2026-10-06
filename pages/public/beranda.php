<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SMK Perkapalan Al-Zaytun - Membangun Generasi Maritim Unggul">
  <title>SMK Perkapalan Al-Zaytun</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/logo jae.png" type="image/png">
  <script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js"></script>
  <link rel="stylesheet" href="format_css/style.css">
</head> 
<body>
  <a href="#main-content" class="skip-link">Langsung ke konten</a>

  <nav class="navbar">
    <div class="container navbar-container">
      <div class="navbar-brand">
        <span class="brand-icon">
          <img src="images/logo jae.png" alt="Logo SMK Perkapalan Al-Zaytun" width="50" height="50">
        </span>
        <h1 class="brand-title">MAK Perkapalan Al-Zaytun</h1>
      </div>
      <div class="navbar-menu">
        <button id="nav-beranda" class="nav-link active" onclick="showPage('beranda')">Beranda</button>
        <button id="nav-profil" class="nav-link" onclick="scrollToSection('profil-section')">Profil</button>
        <button id="nav-fasilitas" class="nav-link" onclick="scrollToSection('fasilitas-section')">Fasilitas</button>
        <button id="nav-laporan" class="nav-link" onclick="window.location.href='index.php?route=halaman_login'">Laporan</button>
        <button class="nav-link login-nav-btn" onclick="window.location.href='index.php?route=halaman_login'">Login</button>
      </div>
      <button class="navbar-toggle" onclick="toggleMobileMenu()" aria-label="Toggle menu">
        <i data-lucide="menu" class="icon-menu"></i>
      </button>
    </div>
    <div id="mobile-menu" class="mobile-menu">
      <button class="mobile-link" onclick="showPage('beranda'); closeMobileMenu()">Beranda</button>
      <button class="mobile-link" onclick="scrollToSection('profil-section'); closeMobileMenu()">Profil</button>
      <button class="mobile-link" onclick="scrollToSection('fasilitas-section'); closeMobileMenu()">Fasilitas</button>
      <button class="mobile-link" onclick="window.location.href='index.php?route=halaman_login'">Laporan</button>
      <button class="mobile-link" onclick="window.location.href='index.php?route=halaman_login'">Login</button>
    </div>
  </nav>

  <main id="main-content">
    <div id="page-beranda" class="page active">
      <header class="hero">
        <img class="hero-image" src="images/samudra biru.png" alt="Foto Kapal Perkapalan" loading="eager">
        <div class="hero-overlay"></div>
        <div class="hero-content">
          <h2 class="hero-title">Membangun Generasi Maritim Unggul</h2>
          <p style="color: black;" class="hero-subtitle"><strong>Perkapalan Al-Zaytun</strong> berkomitmen mencetak lulusan kompeten di bidang kelautan dan perkapalan dengan standar industri nasional.</p>
          <button class="btn btn-primary btn-lg" onclick="window.location.href='index.php?route=halaman_login'">
            <i data-lucide="file-plus" class="btn-icon"></i>
            Masuk Sebagai Anggota
          </button>
        </div>
        <button class="hero-scroll" type="button" onclick="scrollToSection('profil-section')" aria-label="Lihat profil">
          <i data-lucide="chevron-down" class="scroll-icon"></i>
        </button>
      </header>

      <section id="profil-section" class="section section-profil">
        <div class="container grid-2">
          <div class="profil-content fade-in">
            <span class="section-label">Tentang Kami</span>
            <h2 class="section-title">Visi & Misi SMK Perkapalan Al-Zaytun</h2>
            <p class="section-text">Kami berkomitmen untuk menghasilkan tenaga ahli perkapalan yang profesional, berakhlak mulia, dan siap bersaing di era global.</p>
            <p class="section-text">Dengan kurikulum berbasis kompetensi dan fasilitas praktikum modern, siswa dibekali keterampilan teknis dan soft skills yang relevan dengan kebutuhan industri maritim.</p>
            <div class="profil-stats">
              <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Lulusan</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">15+</span>
                <span class="stat-label">Instruktur</span>
              </div>
              <div class="stat-item">
                <span class="stat-number">98%</span>
                <span class="stat-label">Penyerapan Kerja</span>
              </div>
            </div>
          </div>
          <div class="profil-image-wrapper fade-in delay-200">
            <img src="images/ustad imam.jpeg" alt="Fasilitas SMK Perkapalan">
            <div class="image-badge">
              <i data-lucide="award" class="badge-icon"></i>
              <span>Akreditasi A</span>
            </div>
          </div>
        </div>
      </section>

      <section id="fasilitas-section" class="section section-fasilitas">
        <div class="container">
          <div class="section-header text-center">
            <span class="section-label">Fasilitas</span>
            <h2 class="section-title">Laboratorium & Praktik</h2>
            <p class="section-desc">Dilengkapi dengan sarana modern untuk mendukung pembelajaran berbasis praktik.</p>
          </div>
          <div class="grid-3">
            <button type="button" class="card card-fasilitas fade-in" onclick="window.location.href='index.php?route=workshop_perkapalan'">
              <div class="card-image">
                <img src="images/workshop.jpg" alt="Workshop Perkapalan">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Workshop Perkapalan</h3>
                <p class="card-desc">Area praktik kapal, mesin, dan fabrikasi dengan pendekatan industri modern.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>

            <button type="button" class="card card-fasilitas fade-in delay-100" onclick="window.location.href='index.php?route=teknik_besi'">
              <div class="card-image">
                <img src="images/download (2).jpg" alt="Teknik Besi dan Pengelasan">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Teknik Besi & Pengelasan</h3>
                <p class="card-desc">Pelatihan dasar hingga lanjutan dalam pengelasan, pemotongan, dan fabrikasi logam.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>

            <button type="button" class="card card-fasilitas fade-in delay-200" onclick="window.location.href='index.php?route=samudra_biru'">
              <div class="card-image">
                <img src="images/samudra biru.png" alt="Program Samudra Biru">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Samudra Biru</h3>
                <p class="card-desc">Pembelajaran maritim dan navigasi berbasis simulasi untuk membangun kesiapan operasional.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>

            <button type="button" class="card card-fasilitas fade-in delay-100" onclick="window.location.href='index.php?route=tenaga_ahli_guru_perkapalan'">
              <div class="card-image">
                <img src="images/syaykh.png" alt="Guru dan Tenaga Ahli Perkapalan">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Guru & Tenaga Ahli Perkapalan</h3>
                <p class="card-desc">Tim pengajar dan praktisi profesional yang membimbing siswa dengan pendekatan industri.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>

            <button type="button" class="card card-fasilitas fade-in delay-100" onclick="window.location.href='index.php?route=prestasi'">
              <div class="card-image">
                <img src="images/ustad imam.jpeg" alt="Prestasi Perkapalan">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Prestasi Perkapalan</h3>
                <p class="card-desc">Jejak keberhasilan siswa dalam lomba, karya inovatif, dan kompetisi maritim.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>

            <button type="button" class="card card-fasilitas fade-in delay-100" onclick="window.location.href='index.php?route=beranda'">
              <div class="card-image">
                <img src="images/download (2).jpg" alt="Program Unggulan Perkapalan">
                <div class="card-overlay"></div>
              </div>
              <div class="card-content">
                <h3 class="card-title">Program Unggulan</h3>
                <p class="card-desc">Kegiatan pembelajaran berbasis kompetensi yang siap membentuk generasi maritim unggul.</p>
                <span class="card-action"><span class="card-action-label">Lihat halaman</span><span aria-hidden="true">→</span></span>
              </div>
            </button>
          </div>
        </div>
      </section>


      <footer class="footer">
        <div class="container footer-grid">
          <div class="footer-brand">
            <span class="brand-icon"><i class="fas fa-anchor"></i></span>
            <h3>SMK Perkapalan Al-Zaytun</h3>
            <p class="footer-desc">Mencetak generasi maritim unggul, berakhlak, dan siap bersaing di tingkat nasional maupun internasional.</p>
          </div>
          <div class="footer-links">
            <h4>Menu Utama</h4>
            <ul>
              <li><a href="#" onclick="showPage('beranda')">Beranda</a></li>
              <li><a href="#profil-section" onclick="scrollToSection('profil-section')">Profil</a></li>
              <li><a href="#fasilitas-section" onclick="scrollToSection('fasilitas-section')">Fasilitas</a></li>
              <li><a href="index.php?route=halaman_login">Laporan Praktikum</a></li>
            </ul>
          </div>
          <div class="footer-contact">
            <h4>Kontak</h4>
            <ul>
              <li><i data-lucide="map-pin" class="contact-icon"></i> Jl. Pendidikan No. 123, Indonesia</li>
              <li><i data-lucide="phone" class="contact-icon"></i> (021) 1234-5678</li>
              <li><i data-lucide="mail" class="contact-icon"></i> info@smkperkapalan.sch.id</li>
            </ul>
          </div>
        </div>
        <div class="footer-bottom">
          <p>2026 SMK Perkapalan Al-Zaytun. All rights reserved.</p>
        </div>
      </footer>
    </div>
  </main>

  <script src="format_js/script.js"></script>
</body>
</html>