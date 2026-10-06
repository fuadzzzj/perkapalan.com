<?php
$currentPage = isset($_GET['route']) && is_string($_GET['route']) ? $_GET['route'] : '';

$navItems = [
    'beranda' => ['label' => 'Beranda', 'href' => 'index.php?route=beranda'],
    'teknik_besi' => ['label' => 'Teknik Besi', 'href' => 'index.php?route=teknik_besi'],
    'samudra_biru' => ['label' => 'Samudra Biru', 'href' => 'index.php?route=samudra_biru'],
    'workshop_perkapalan' => ['label' => 'Workshop', 'href' => 'index.php?route=workshop_perkapalan'],
    'prestasi' => ['label' => 'Prestasi', 'href' => 'index.php?route=prestasi'],
    'tenaga_ahli_guru_perkapalan' => ['label' => 'Tenaga Ahli', 'href' => 'index.php?route=tenaga_ahli_guru_perkapalan'],
    'dashboard' => ['label' => 'Dashboard', 'href' => 'index.php?route=dashboard'],
];
?>

<link rel="stylesheet" href="format_css/service_navbar.css">

<header id="site-nav-header">
    <div class="site-nav-bar">
        <a class="site-nav-brand" href="index.php?route=beranda" aria-label="Beranda SMK Perkapalan Al-Zaytun">
            <span class="site-nav-brand-mark" aria-hidden="true"></span>
            <span>SMK Perkapalan</span>
        </a>

        <nav class="site-nav-links" aria-label="Navigasi utama">
            <?php foreach ($navItems as $page => $item): ?>
                <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                   <?php echo $currentPage === $page ? 'class="site-nav-current" aria-current="page"' : ''; ?>>
                    <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </nav>

        <a class="site-nav-cta" href="index.php?route=halaman_login">Masuk</a>
        <button class="site-nav-burger" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="site-nav-sheet">
            <span></span><span></span>
        </button>
    </div>

    <div class="site-nav-sheet" id="site-nav-sheet" aria-hidden="true">
        <nav aria-label="Menu seluler">
            <?php $navIndex = 0; foreach ($navItems as $page => $item): ?>
                <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>"
                   style="--site-nav-index: <?php echo $navIndex++; ?>"
                   <?php echo $currentPage === $page ? 'aria-current="page"' : ''; ?>>
                    <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </nav>
        <a class="site-nav-cta" href="index.php?route=halaman_login">Masuk</a>
    </div>
</header>
