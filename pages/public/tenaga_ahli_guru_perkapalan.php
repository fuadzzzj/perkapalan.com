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
    <title>Guru & Tenaga Ahli Perkapalan</title>
    <meta name="description" content="Profil guru dan tenaga ahli perkapalan untuk membimbing siswa dalam pembelajaran maritim dan teknik kapal.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="format_css/tenaga_ahli_guru.css">
</head>
<body>
    <?php include APP_ROOT . '/service/navbar.php'; ?>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <p class="eyebrow">Guru & Tenaga Ahli</p>
            <h1>Menanamkan <span>Ilmu</span> dan <span>Keterampilan</span> Perkapalan</h1>
            <p>
                Tim guru dan tenaga ahli perkapalan kami adalah pendamping utama dalam membentuk siswa menjadi
                tenaga yang siap kerja, disiplin, dan kompeten dalam dunia maritim.
            </p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#profil">Lihat Profil</a>
                <a class="btn btn-secondary" href="#tenaga-ahli">Tim Kami</a>
            </div>
        </div>
    </section>

    <main>
        <section class="section intro" id="profil">
            <div class="container intro-grid">
                <div class="intro-copy reveal">
                    <p class="label">Tentang Kami</p>
                    <h2>Guru dan tenaga ahli yang membimbing menuju dunia maritim profesional</h2>
                    <p>
                        Kami hadir untuk menyiapkan peserta didik dalam memahami teori, praktik, dan karakter kerja
                        di bidang perkapalan. Setiap sesi pembelajaran didesain agar siswa tidak hanya pintar, tetapi
                        juga siap menghadapi tantangan nyata di industri maritim.
                    </p>
                    <p>
                        Dari teknik dasar kapal, keselamatan kerja, hingga pengelolaan peralatan dan metode kerja industri,
                        semua dipelajari dengan pendekatan yang aplikatif, terarah, dan berorientasi pada kualitas.
                    </p>
                </div>

                <div class="summary-box reveal">
                    <div class="summary-item">
                        <strong>12+</strong>
                        <span>Guru dan instruktur aktif</span>
                    </div>
                    <div class="summary-item">
                        <strong>4</strong>
                        <span>Bidang keahlian utama</span>
                    </div>
                    <div class="summary-item">
                        <strong>100%</strong>
                        <span>Orientasi pada praktik nyata</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="peran">
            <div class="container">
                <div class="section-header reveal">
                    <p class="label">Peran Utama</p>
                    <h2>Apa tugas mereka?</h2>
                </div>

                <div class="role-grid">
                    <article class="role-card reveal">
                        <div class="role-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h3>Guru Teori</h3>
                        <p>Menyampaikan dasar-dasar perkapalan, teknik mesin, keselamatan kerja, serta materi akademik yang menunjang keterampilan praktik.</p>
                    </article>

                    <article class="role-card reveal">
                        <div class="role-icon"><i class="fas fa-gears"></i></div>
                        <h3>Instruktur Praktik</h3>
                        <p>Membimbing siswa saat melakukan praktik di workshop, mulai dari pengukuran, pemotongan, perakitan, hingga finishing produk.</p>
                    </article>

                    <article class="role-card reveal">
                        <div class="role-icon"><i class="fas fa-compass"></i></div>
                        <h3>Tenaga Ahli Teknis</h3>
                        <p>Memberikan penguatan keahlian teknis berdasarkan standar kerja, kebutuhan industri, dan pengalaman lapangan yang nyata.</p>
                    </article>

                    <article class="role-card reveal">
                        <div class="role-icon"><i class="fas fa-handshake"></i></div>
                        <h3>Mentor Karakter</h3>
                        <p>Menanamkan disiplin, tanggung jawab, kerja tim, dan etos kerja yang diperlukan dalam dunia maritim dan industri.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section" id="tenaga-ahli">
            <div class="container">
                <div class="section-header reveal">
                    <p class="label">Tim Kami</p>
                    <h2>Guru dan tenaga ahli perkapalan</h2>
                </div>

                <div class="profile-grid">
                    <article class="profile-card reveal">
                        <div class="profile-image">
                            <img src="images/guru_1.png" alt="Foto Guru Perkapalan 1">
                        </div>
                        <div class="profile-body">
                            <h3>Ahmad Zulfikar</h3>
                            <p class="position">Kepala Program Perkapalan</p>
                            <p>Memimpin pembelajaran dan memastikan kurikulum sesuai kebutuhan industri maritim.</p>
                        </div>
                    </article>

                    <article class="profile-card reveal">
                        <div class="profile-image">
                            <img src="images/guru_2.png" alt="Foto Guru Perkapalan 2">
                        </div>
                        <div class="profile-body">
                            <h3>Rizki Pratama</h3>
                            <p class="position">Instruktur Teknik Bangunan Kapal</p>
                            <p>Berfokus pada struktur kapal, pemilihan material, serta pengerjaan teknik fabrikasi.</p>
                        </div>
                    </article>

                    <article class="profile-card reveal">
                        <div class="profile-image">
                            <img src="images/guru_3.png" alt="Foto Guru Perkapalan 3">
                        </div>
                        <div class="profile-body">
                            <h3>Siti Nurhaliza</h3>
                            <p class="position">Instruktur Keselamatan Kerja</p>
                            <p>Mengajarkan protokol keamanan, penggunaan alat, dan manajemen risiko di lingkungan kerja.</p>
                        </div>
                    </article>

                    <article class="profile-card reveal">
                        <div class="profile-image">
                            <img src="images/guru_4.png" alt="Foto Guru Perkapalan 4">
                        </div>
                        <div class="profile-body">
                            <h3>Fadli Syahputra</h3>
                            <p class="position">Tenaga Ahli Mesin Kapal</p>
                            <p>Berpengalaman dalam perawatan mesin, sistem kelistrikan, dan operasional alat berat kapal.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section values">
            <div class="container values-grid">
                <div class="values-copy reveal">
                    <p class="label">Kenapa penting?</p>
                    <h2>Tim kami menjadi penghubung antara teori, praktik, dan kebutuhan industri</h2>
                    <p>
                        Guru dan tenaga ahli perkapalan tidak hanya mengajar, tetapi juga membentuk pola pikir siswa agar
                        siap bekerja, beradaptasi, dan menghasilkan karya yang berkualitas.
                    </p>
                </div>

                <div class="value-list reveal">
                    <div class="value-item">
                        <span class="value-number">01</span>
                        <div>
                            <h3>Kompeten</h3>
                            <p>Pengajaran didukung oleh pemahaman teknis yang sesuai kebutuhan lapangan.</p>
                        </div>
                    </div>

                    <div class="value-item">
                        <span class="value-number">02</span>
                        <div>
                            <h3>Profesional</h3>
                            <p>Menumbuhkan kedisiplinan, tanggung jawab, dan kualitas kerja yang terukur.</p>
                        </div>
                    </div>

                    <div class="value-item">
                        <span class="value-number">03</span>
                        <div>
                            <h3>Siap Kerja</h3>
                            <p>Membekali siswa dengan keterampilan yang bisa langsung diterapkan di lingkungan industri.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container cta-box reveal">
            <p class="label light">Bersama Kami</p>
            <h2>Siap membangun generasi maritim yang unggul</h2>
            <p>
                Kami membantu siswa tumbuh menjadi tenaga ahli yang siap menghadapi dunia kerja perkapalan dengan
                kemampuan teknis, sikap profesional, dan semangat belajar yang tinggi.
            </p>
            <a class="btn btn-primary" href="index.php?route=halaman_login">Daftar / Masuk</a>
        </div>
    </section>

    <footer class="footer">
        <div class="container footer-inner">
            <div>
                <h3>Perkapalan</h3>
                <p>Menyiapkan siswa menjadi generasi maritim yang terampil, disiplin, dan siap bersaing.</p>
            </div>
            <div>
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="index.php?route=beranda">Beranda</a></li>
                    <li><a href="#profil">Profil</a></li>
                    <li><a href="#tenaga-ahli">Tenaga Ahli</a></li>
                </ul>
            </div>
            <div>
                <h4>Kontak</h4>
                <ul>
                    <li>Jl. Perkapalan No. 12</li>
                    <li>info@perkapalan.sch.id</li>
                    <li>+62 812-3456-7890</li>
                </ul>
            </div>
        </div>
        <div class="container footer-bottom">© 2026 Perkapalan. Semua hak dilindungi.</div>
    </footer>

    <script src="format_js/tenaga_ahli_guru.js"></script>
</body>
</html>
