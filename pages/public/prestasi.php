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
    <title>Prestasi Perkapalan</title>
    <meta name="description" content="Prestasi perkapalan sekolah dengan cerita perjalanan, lomba, dan dokumentasi kegiatan.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="format_css/prestasi.css">
</head>
<body>
    <?php include APP_ROOT . '/service/navbar.php'; ?>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <p class="eyebrow">Prestasi Kami</p>
            <h1>Mengukir <span>Keberhasilan</span> di Dunia Maritim</h1>
            <p>
                Dari lomba teknis hingga kegiatan maritim, setiap prestasi adalah hasil kerja keras, semangat,
                dan perjalanan panjang para siswa perkapalan kami.
            </p>
            <a class="btn btn-primary" href="#prestasi">Lihat Prestasi</a>
        </div>
    </section>

    <main id="prestasi" class="section">
        <div class="container">
            <div class="section-header">
                <p class="label">Prestasi Terbaru</p>
                <h2>Perjalanan kami dalam meraih juara</h2>
            </div>

            <div class="prestasi-layout">
                <div class="achievement-list">
                    <button class="achievement-card active" data-id="lomba-kapal">
                        <span class="badge">Juara 1</span>
                        <h3>Lomba Kapal Mini Antar Sekolah</h3>
                        <p>Desain dan pembuatan kapal mini dengan konsep efisien dan inovatif.</p>
                    </button>

                    <button class="achievement-card" data-id="lomba-navigasi">
                        <span class="badge">Juara 2</span>
                        <h3>Lomba Navigasi & Keselamatan Laut</h3>
                        <p>Kemampuan membaca peta, koordinasi tim, dan simulasi situasi darurat.</p>
                    </button>

                    <button class="achievement-card" data-id="lomba-las">
                        <span class="badge">Juara 3</span>
                        <h3>Kompetisi Las & Fabrikasi</h3>
                        <p>Ketelitian dalam pengelasan, kualitas sambungan, dan hasil finishing.</p>
                    </button>

                    <button class="achievement-card" data-id="lomba-inovasi">
                        <span class="badge">Finalis</span>
                        <h3>Inovasi Teknologi Perkapalan</h3>
                        <p>Ide kreatif untuk solusi kerja di sektor maritim dan teknologi kapal.</p>
                    </button>
                </div>

                <article class="achievement-detail" id="detail-prestasi">
                    <div class="detail-header">
                        <p class="label">Detail Prestasi</p>
                        <h2 id="detail-title">Lomba Kapal Mini Antar Sekolah</h2>
                    </div>

                    <div class="detail-cover">
                        <img id="detail-image" src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=1200&q=80" alt="Lomba kapal mini">
                    </div>

                    <div class="detail-meta">
                        <span id="detail-rank">Juara 1</span>
                        <span id="detail-year">2025</span>
                    </div>

                    <div class="detail-content">
                        <p id="detail-summary">
                            Tim perkapalan kami berhasil menjuarai lomba kapal mini antar sekolah dengan desain yang ringan,
                            stabil, dan efisien. Keberhasilan ini tidak datang dari satu hari, melainkan hasil latihan, evaluasi,
                            dan kerja tim yang konsisten.
                        </p>

                        <h3>Cerita perjalanan</h3>
                        <p id="detail-story">
                            Awalnya, kami hanya mencoba membuat prototype kapal mini dari bahan yang sederhana. Banyak bagian harus
                            diperbaiki karena hasilnya belum stabil saat diuji di air. Kami belajar dari setiap kesalahan, mulai dari
                            bentuk lambung hingga keseimbangan saat kapal melaju. Proses ini memakan waktu cukup lama, tetapi membuat
                            kami semakin paham pentingnya ketelitian, eksperimen, dan kerja sama tim.
                        </p>

                        <div class="gallery-grid" id="detail-gallery">
                            <img src="https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=800&q=80" alt="Proses pembuatan kapal">
                            <img src="https://images.unsplash.com/photo-1520637836862-4d197d17c90a?auto=format&fit=crop&w=800&q=80" alt="Perjalanan lomba">
                            <img src="https://images.unsplash.com/photo-1493246507139-91e8fad9978e?auto=format&fit=crop&w=800&q=80" alt="Tim merayakan hasil">
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </main>

    <?php require APP_ROOT . '/layout/footer.html'; ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
   <script src="format_js/navbar.js"></script>

    <script src="format_js/prestasi.js"></script>
</body>
</html>
