<?php
define('APP_ROOT', __DIR__);

$routes = [
    'beranda' => 'pages/public/beranda.php',
    'prestasi' => 'pages/public/prestasi.php',
    'samudra_biru' => 'pages/public/samudra_biru.php',
    'teknik_besi' => 'pages/public/teknik_besi.php',
    'tenaga_ahli_guru_perkapalan' => 'pages/public/tenaga_ahli_guru_perkapalan.php',
    'workshop_perkapalan' => 'pages/public/workshop_perkapalan.php',
    'halaman_login' => 'pages/auth/halaman_login.php',
    'register' => 'pages/auth/register.php',
    'dashboard' => 'pages/student/dashboard.php',
    'fitur_pelajar' => 'pages/student/fitur_pelajar.php',
    'portal_pelajar' => 'pages/student/portal_pelajar.php',
    'portal_utama' => 'pages/student/portal_utama.php',
    'admin' => 'pages/teacher/admin.php',
    'chat' => 'pages/shared/chat.php',
];

$route = $_GET['route'] ?? 'beranda';
if (!is_string($route) || !isset($routes[$route])) {
    http_response_code(404);
    echo 'Halaman tidak ditemukan.';
    exit;
}

require APP_ROOT . '/' . $routes[$route];
