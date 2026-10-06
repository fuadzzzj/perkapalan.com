<?php
if (!defined('APP_ROOT')) {
    http_response_code(404);
    exit;
}

$pageTitle = 'Workshop Kapal - Ponpes Al-Zaytun';

require __DIR__ . '/views/workshop_perkapalan.php';
