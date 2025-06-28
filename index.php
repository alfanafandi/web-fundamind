<?php
require_once 'pages/db.php';

$modul = $_GET['modul'] ?? '';
$fitur = $_GET['fitur'] ?? '';

if ($modul === '') {
    header("Location: pages/dashboard.php");
    exit;
}

if ($modul === 'auth') {
    include 'controllers/auth_controller.php';
}

if ($modul === 'user') {
    require_once __DIR__ . '../controllers/users_controller.php';
    $controller = new UserController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'admin') {
    require_once __DIR__ . '../controllers/admin_controller.php';
    $controller = new AdminController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'achievement') {
    include_once 'controllers/achievement_controller.php';
    $controller = new AchievementController($koneksi);
    $controller->handle($fitur);
}


