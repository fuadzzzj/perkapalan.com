<?php
// Route utama berasal dari dispatcher index.php.
$current_page = isset($_GET['route']) && is_string($_GET['route']) ? $_GET['route'] : 'beranda';

// 2. Konfigurasi Tema untuk setiap halaman
$themes = [
    'beranda' => [
        'title' => 'Mahad Welding',
        'icon'  => 'fas fa-fire-alt', // Api (Welder)
        'color' => '#ff6b35'          // Oranye
    ],
    'samudra_biru' => [
        'title' => 'Samudra Biru',
        'icon'  => 'fas fa-water',    // Gelombang Air
        'color' => '#4ecdc4'          // Biru Laut
    ],
    'teknik_besi' => [
        'title' => 'Teknik Besi',
        'icon'  => 'fas fa-hammer',   // Palu/Besi
        'color' => '#e74c3c'          // Merah Besi
    ],
    'workshop_perkapalan' => [
        'title' => 'Workshop Perkapalan',
        'icon'  => 'fas fa-ship',     // Kapal
        'color' => '#f1c40f'          // Kuning Emas
    ]
];
$theme = $themes[$current_page] ?? $themes['beranda'];
?>

<link rel="stylesheet" href="format_css/layout_navbar.css">
