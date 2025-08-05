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
    include_once 'controllers/users_controller.php';
    $controller = new UserController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'admin') {
    include_once 'controllers/admin_controller.php';
    $controller = new AdminController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'achievement') {
    include_once 'controllers/achievement_controller.php';
    $controller = new AchievementController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'shop') {
    include_once 'controllers/shop_controller.php';
    $controller = new ShopController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'quest') {
    include_once 'controllers/quest_controller.php';
    $controller = new QuestController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'quest_chapter') {
    include_once 'controllers/quest_chapter_controller.php';
    $controller = new QuestChapterController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'quest_question') {
    include_once 'controllers/quest_question_controller.php';
    $controller = new QuestQuestionController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'challenge_scores') {
    include_once 'controllers/challenge_scores_controller.php';
    $controller = new ChallengeScoresController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'boss_quest') {
    include_once 'controllers/boss_quest_controller.php';
    $controller = new BossQuestController($koneksi);
    $controller->handle($fitur);
}

if ($modul === 'boss_question') {
    include_once 'controllers/boss_question_controller.php';
    $controller = new BossQuestionController($koneksi);
    $controller->handle($fitur);
}


