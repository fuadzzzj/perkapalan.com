<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="format_css/workshop_perkapalan.css">
</head>
<body>

<?php include APP_ROOT . '/service/navbar.php'; ?>

<!-- HERO -->
<section class="hero" id="beranda">
  <div class="hero-content">
    <span class="hero-tag"><i class="fas fa-ship"></i> Workshop Vokasi Maritim</span>
    <h1>Membangun Kapal, <br>Membentuk <span>Karakter Santri</span></h1>
    <p>Workshop pembuatan kapal di Ponpes Al-Zaytun memadukan keterampilan maritim, kedisiplinan, dan nilai-nilai keislaman untuk mencetak generasi yang siap menghadapi tantangan lautan masa depan.</p>
    <div class="btn-group">
      <a href="#kegiatan" class="btn btn-primary">Lihat Kegiatan →</a>
      <a href="#proses" class="btn btn-outline">Proses Pembuatan</a>
    </div>
  </div>
  <svg class="wave" viewBox="0 0 1440 100" preserveAspectRatio="none">
    <path fill="#fafafa" d="M0,50 C360,100 1080,0 1440,50 L1440,100 L0,100 Z"/>
  </svg>
</section>

<!-- ABOUT -->
<section class="about" id="tentang">
  <div class="about-img reveal">
    <div class="badge">Sejak 2018</div>
  </div>
  <div class="about-text reveal">
    <small style="color: var(--gold); font-weight: 600; letter-spacing: 3px;">TENTANG WORKSHOP</small>
    <h2>Tempa Diri di Tepi Samudra Ilmu</h2>
    <p>Workshop pembuatan kapal Ponpes Al-Zaytun merupakan program vokasi unggulan yang melatih santri dalam bidang pertukangan kapal, teknik permesinan, dan desain perkapalan modern.</p>
    <p>Dibimbing oleh instruktur berpengalaman, santri tidak hanya belajar keterampilan teknis, tetapi juga nilai-nilai kerja keras, ketelitian, dan ukhuwah yang menjadi fondasi kehidupan.</p>
    <div class="about-features">
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-hammer"></i></div>
        <div>
          <h4>Pertukangan</h4>
          <p>Teknik kayu & fiberglass</p>
        </div>
      </div>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-gears"></i></div>
        <div>
          <h4>Mesin Kapal</h4>
          <p>Perawatan & instalasi</p>
        </div>
      </div>
      <div class="feature">
        <div class="feature-icon">📐</div>
        <div>
          <h4>Desain Kapal</h4>
          <p>CAD & perencanaan</p>
        </div>
      </div>
      <div class="feature">
        <div class="feature-icon"><i class="fas fa-compass"></i></div>
        <div>
          <h4>Navigasi</h4>
          <p>Dasar pelayaran</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KEGIATAN -->
<section class="kegiatan" id="kegiatan">
  <div class="section-title reveal">
    <small>Program Unggulan</small>
    <h2>Kegiatan Workshop Kami</h2>
    <div class="underline"></div>
  </div>
  <div class="cards">
    <div class="card reveal">
      <div class="card-img">🪚</div>
      <div class="card-body">
        <span class="card-tag">Mingguan</span>
        <h3>Pemotongan & Pembentukan Kayu</h3>
        <p>Santri belajar memilih material, memotong, dan membentuk lunas serta rusuk kapal dengan presisi tinggi.</p>
      </div>
    </div>
    <div class="card reveal">
      <div class="card-img">🔩</div>
      <div class="card-body">
        <span class="card-tag">Harian</span>
        <h3>Perakitan Struktur Kapal</h3>
        <p>Proses penyambungan rangka kapal menggunakan teknik tradisional dan modern sesuai standar BKI.</p>
      </div>
    </div>
    <div class="card reveal">
      <div class="card-img">🎨</div>
      <div class="card-body">
        <span class="card-tag">Bulanan</span>
        <h3>Pengecatan & Finishing</h3>
        <p>Aplikasi cat anti-fouling, epoxy, dan finishing dekoratif untuk ketahanan kapal di air laut.</p>
      </div>
    </div>
    <div class="card reveal">
      <div class="card-img">🛠️</div>
      <div class="card-body">
        <span class="card-tag"> Rutin</span>
        <h3>Instalasi Mesin & Kelistrikan</h3>
        <p>Pemasangan engine, sistem bahan bakar, serta instalasi kelistrikan kapal sesuai standar keselamatan.</p>
      </div>
    </div>
    <div class="card reveal">
      <div class="card-img"><i class="fas fa-chart-bar"></i></div>
      <div class="card-body">
        <span class="card-tag">Khusus</span>
        <h3>Desain & Perencanaan</h3>
        <p>Penggunaan software CAD untuk merancang bentuk hull, stabilitas, dan rencana umum kapal.</p>
      </div>
    </div>
    <div class="card reveal">
      <div class="card-img">🌊</div>
      <div class="card-body">
        <span class="card-tag">Akhir Program</span>
        <h3>Uji Coba & Peluncuran</h3>
        <p>Sea trial untuk menguji kelaikan kapal sebelum diserahkan atau digunakan untuk pelatihan santri.</p>
      </div>
    </div>
  </div>
</section>

<!-- TIMELINE -->
<section class="timeline-section" id="proses">
  <div class="section-title reveal">
    <small style="color: var(--gold);">Alur Produksi</small>
    <h2>Proses Pembuatan Kapal</h2>
    <div class="underline"></div>
  </div>
  <div class="timeline">
    <div class="timeline-item reveal">
      <div class="timeline-content">
        <span class="step">TAHAP 01</span>
        <h4>Perencanaan & Desain</h4>
        <p>Penyusunan gambar kerja, perhitungan stabilitas, dan pemilihan material sesuai spesifikasi.</p>
      </div>
    </div>
    <div class="timeline-item reveal">
      <div class="timeline-content">
        <span class="step">TAHAP 02</span>
        <h4>Pembuatan Lunas</h4>
        <p>Penyusunan keel dan tulang punggung kapal sebagai fondasi utama struktur.</p>
      </div>
    </div>
    <div class="timeline-item reveal">
      <div class="timeline-content">
        <span class="step">TAHAP 03</span>
        <h4>Pemasangan Rusuk & Kulit</h4>
        <p>Frame, stringer, dan planking dipasang membentuk body kapal yang kokoh.</p>
      </div>
    </div>
    <div class="timeline-item reveal">
      <div class="timeline-content">
        <span class="step">TAHAP 04</span>
        <h4>Deck & Interior</h4>
        <p>Pembangunan geladak, kabin, dan sistem interior sesuai fungsi kapal.</p>
      </div>
    </div>
    <div class="timeline-item reveal">
      <div class="timeline-content">
        <span class="step">TAHAP 05</span>
        <h4>Finishing & Peluncuran</h4>
        <p>Pengecatan, instalasi mesin, uji kelaikan, dan launching kapal ke perairan.</p>
      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<section class="stats">
  <div class="stats-grid">
    <div>
      <div class="stat-num">120+</div>
      <div class="stat-label">Santri Terlatih</div>
    </div>
    <div>
      <div class="stat-num">15</div>
      <div class="stat-label">Kapal Dibangun</div>
    </div>
    <div>
      <div class="stat-num">8</div>
      <div class="stat-label">Instruktur Ahli</div>
    </div>
    <div>
      <div class="stat-num">7</div>
      <div class="stat-label">Tahun Berjalan</div>
    </div>
  </div>
</section>

<!-- GALERI -->
<section id="galeri">
  <div class="section-title reveal">
    <small>Dokumentasi</small>
    <h2>Galeri Kegiatan</h2>
    <div class="underline"></div>
  </div>
  <div class="gallery-grid">
    <div class="gallery-item reveal" data-caption="Pemotongan kayu lunas">🪚</div>
    <div class="gallery-item reveal" data-caption="Perakitan rangka kapal"><i class="fas fa-hammer"></i></div>
    <div class="gallery-item reveal" data-caption="Pengecatan lambung">🎨</div>
    <div class="gallery-item reveal" data-caption="Instalasi mesin"><i class="fas fa-gears"></i></div>
    <div class="gallery-item reveal" data-caption="Uji coba di perairan">🚤</div>
    <div class="gallery-item reveal" data-caption="Kebersamaan santri">👥</div>
  </div>
</section>

<!-- CTA -->
<section class="cta">
  <h2>Tertarik Bergabung?</h2>
  <p>Jadilah bagian dari generasi santri yang menguasai keterampilan maritim dan berkarakter mulia. Pendaftaran santri baru dibuka setiap tahun.</p>
  <a href="#kontak" class="btn btn-primary">Hubungi Kami →</a>
</section>

<!-- FOOTER -->
<?php require APP_ROOT . '/layout/footer.html'; ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
   <script src="format_js/navbar.js"></script>

<script src="format_js/workshop_perkapalan.js"></script>
</body>
</html>