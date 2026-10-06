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
    <title>Samudra Biru - Kegiatan & Materi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="format_css/samudra_biru.css">
</head>
<body>
    <?php include APP_ROOT . '/service/navbar.php'; ?>

    <section class="hero" id="beranda">
        <div class="hero-content">
            <div class="eyebrow">Kegiatan Kelautan & Maritim</div>
            <h1>Mengasah <span>Semangat Laut</span> melalui Praktik Nyata</h1>
            <p>
                Samudra Biru adalah wadah pembelajaran yang menyiapkan santri dan siswa untuk memahami dunia maritim,
                keselamatan di perairan, serta keterampilan teknis yang dibutuhkan di industri kelautan modern.
            </p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#kegiatan">Lihat Kegiatan</a>
                <a class="btn btn-secondary" href="#materi">Materi yang Diajar</a>
            </div>
        </div>
    </section>

    <main>
        <section class="section" id="tentang">
            <div class="container about">
                <div class="about-visual">
                    <img src="images/samudra_1.jpg" alt="Kegiatan Samudra Biru">
                    <div class="badge">Belajar dengan pendekatan praktik dan lingkungan nyata</div>
                </div>
                <div class="about-card">
                    <div class="section-header about-header">
                        <div class="label">Tentang Samudra Biru</div>
                        <h2>Menumbuhkan semangat maritim sejak dini</h2>
                    </div>
                    <p>
                        Samudra Biru bukan sekadar kegiatan tambahan, tetapi ruang pembelajaran yang menyatukan teori,
                        simulasi, dan praktik lapangan untuk membentuk karakter siswa yang disiplin, berani, dan siap menghadapi tantangan laut.
                    </p>
                    <p>
                        Di sini, kami menanamkan pemahaman tentang navigasi, keamanan perairan, manajemen kapal,
                        serta cara bekerja secara profesional dalam lingkungan maritim yang dinamis.
                    </p>
                    <div class="mini-grid">
                        <div class="mini-item">
                            <strong>Praktik</strong>
                            <span>Belajar langsung di lapangan</span>
                        </div>
                        <div class="mini-item">
                            <strong>Simulasi</strong>
                            <span>Latihan dan pengenalan situasi nyata</span>
                        </div>
                        <div class="mini-item">
                            <strong>Keselamatan</strong>
                            <span>Prioritas utama dalam setiap kegiatan</span>
                        </div>
                        <div class="mini-item">
                            <strong>Karakter</strong>
                            <span>Disiplin, kerja sama, dan tanggung jawab</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section programs" id="kegiatan">
            <div class="container">
                <div class="section-header">
                    <div class="label">Kegiatan Kami</div>
                    <h2>Aktivitas yang Kami Lakukan</h2>
                    <div class="divider"></div>
                </div>

                <div class="cards">
                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_2.jpg" alt="Navigasi laut">
                        </div>
                        <div class="card-body">
                            <div class="tag">Navigasi</div>
                            <h3>Pengenalan Arah & Rute Laut</h3>
                            <p>Siswa dilatih membaca peta, memahami kompas, dan mengenal arah perjalanan laut dengan metode yang mudah dipahami.</p>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_3.jpg" alt="Simulasi kapal">
                        </div>
                        <div class="card-body">
                            <div class="tag">Simulasi</div>
                            <h3>Latihan Situasi Darurat</h3>
                            <p>Peserta diajak memahami prosedur penanganan keadaan darurat, evakuasi, serta koordinasi tim di kondisi kritis.</p>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_4.jpg" alt="Kegiatan keselamatan di laut">
                        </div>
                        <div class="card-body">
                            <div class="tag">Keselamatan</div>
                            <h3>Pelatihan Keselamatan di Perairan</h3>
                            <p>Materi ini mencakup penggunaan alat keselamatan, prosedur penyelamatan diri, hingga pengelolaan peralatan pelindung.</p>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_5.jpg" alt="Pelayaran dan komunikasi">
                        </div>
                        <div class="card-body">
                            <div class="tag">Komunikasi</div>
                            <h3>Komunikasi Radio & Pelayaran</h3>
                            <p>Siswa mempelajari cara berkomunikasi dengan jelas dan efektif di laut, termasuk prosedur standar dalam komunikasi radio.</p>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_6.jpg" alt="Praktik kerja tim">
                        </div>
                        <div class="card-body">
                            <div class="tag">Tim</div>
                            <h3>Kerja Tim & Disiplin</h3>
                            <p>Kegiatan ini menumbuhkan sikap tanggung jawab, koordinasi, dan kedisiplinan dalam menyelesaikan tugas bersama.</p>
                        </div>
                    </article>

                    <article class="card">
                        <div class="card-image">
                            <img src="images/samudra_7.jpg" alt="Praktik pelatihan ketahanan laut">
                        </div>
                        <div class="card-body">
                            <div class="tag">Latihan</div>
                            <h3>Penguatan Ketahanan & Mental Laut</h3>
                            <p>Latihan ini membantu siswa membangun mental siap menghadapi lingkungan kerja yang menantang, dingin, dan penuh tekanan.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="materi">
            <div class="container">
                <div class="section-header">
                    <div class="label">Materi Pembelajaran</div>
                    <h2>Apa yang kami ajarkan?</h2>
                    <div class="divider"></div>
                </div>

                <div class="materi-wrap">
                    <div class="materi-list">
                        <div class="materi-item">
                            <div class="materi-ico"><i class="fas fa-compass"></i></div>
                            <div>
                                <h4>Navigasi Dasar Laut</h4>
                                <p>Memahami kompas, peta, arah angin, posisi kapal, serta cara membaca kondisi lingkungan perairan.</p>
                            </div>
                        </div>

                        <div class="materi-item">
                            <div class="materi-ico">📡</div>
                            <div>
                                <h4>Komunikasi Radio & Signal</h4>
                                <p>Belajar pengiriman sinyal, komunikasi antar kapal, dan prosedur komunikasi yang aman untuk kebutuhan operasional.</p>
                            </div>
                        </div>

                        <div class="materi-item">
                            <div class="materi-ico">🦺</div>
                            <div>
                                <h4>Keselamatan & Survival</h4>
                                <p>Melatih penggunaan alat keselamatan, prosedur penyelamatan diri, serta kesiapan menghadapi keadaan darurat di laut.</p>
                            </div>
                        </div>

                        <div class="materi-item">
                            <div class="materi-ico"><i class="fas fa-gears"></i></div>
                            <div>
                                <h4>Operasional Kapal Sederhana</h4>
                                <p>Mengenal bagian-bagian kapal, cara kerja peralatan, dan fungsi utama sistem operasi kapal kecil.</p>
                            </div>
                        </div>

                        <div class="materi-item">
                            <div class="materi-ico">📚</div>
                            <div>
                                <h4>Etika & Kedisiplinan Kerja</h4>
                                <p>Menumbuhkan sikap profesional, tanggung jawab, serta kedisiplinan yang sangat penting dalam dunia maritim.</p>
                            </div>
                        </div>
                    </div>

                    <div class="materi-visual">
                        <img src="images/samudra_8.jpg" alt="Materi pembelajaran Samudra Biru">
                        <ul class="bullet-list">
                            <li>Melatih kesiapan mental dan fisik untuk kerja di lingkungan laut</li>
                            <li>Memahami sistem keamanan serta standar operasional maritim</li>
                            <li>Mengembangkan rasa tanggung jawab dan kerja sama tim</li>
                            <li>Menyiapkan siswa menjadi generasi yang siap menghadapi dunia kelautan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section gallery" id="galeri">
            <div class="container">
                <div class="section-header">
                    <div class="label">Dokumentasi</div>
                    <h2>Galeri Kegiatan</h2>
                    <div class="divider"></div>
                </div>

                <div class="gallery-grid">
                    <div class="gallery-item">
                        <img src="images/samudra_9.jpg" alt="Foto 1 Samudra Biru">
                        <div class="gallery-caption">Latihan arah dan navigasi</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_10.jpg" alt="Foto 2 Samudra Biru">
                        <div class="gallery-caption">Kegiatan simulasi darurat</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_11.jpg" alt="Foto 3 Samudra Biru">
                        <div class="gallery-caption">Praktik keselamatan laut</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_12.jpg" alt="Foto 4 Samudra Biru">
                        <div class="gallery-caption">Kerja sama tim siswa</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_13.jpg" alt="Foto 5 Samudra Biru">
                        <div class="gallery-caption">Pemahaman peta laut</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_14.jpg" alt="Foto 6 Samudra Biru">
                        <div class="gallery-caption">Pembelajaran komunikasi</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_15.jpg" alt="Foto 7 Samudra Biru">
                        <div class="gallery-caption">Kegiatan pelatihan maritim</div>
                    </div>
                    <div class="gallery-item">
                        <img src="images/samudra_16.jpg" alt="Foto 8 Samudra Biru">
                        <div class="gallery-caption">Semangat belajar di laut</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta">
            <div class="container">
                <div class="cta-box">
                    <h2>Siap Menjadi Generasi Maritim?</h2>
                    <p>
                        Samudra Biru menghadirkan pengalaman belajar yang inspiratif dan aplikatif agar siswa siap berkontribusi di dunia kelautan,
                        industri maritim, dan lingkungan kerja yang menuntut profesionalisme tinggi.
                    </p>
                    <a class="btn btn-primary" href="index.php?route=halaman_login">Daftar Sekarang</a>
                </div>
            </div>
        </section>
    </main>

   <?php require APP_ROOT . '/layout/footer.html'; ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
   <script src="format_js/navbar.js"></script>

    <script src="format_js/samudra_biru.js"></script>
</body>
</html>
