<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil soal berdasarkan level user (contoh sederhana)
$level_user = 1; // Ganti dengan sistem level user sebenarnya
$soal = mysqli_query($koneksi, "SELECT * FROM quest_questions WHERE min_level <= $level_user ORDER BY RAND() LIMIT 10");

$questions = [];
while ($q = mysqli_fetch_assoc($soal)) {
    $questions[] = $q;
}

$_SESSION['challenge_questions'] = $questions;
$_SESSION['challenge_answers'] = [];
$_SESSION['challenge_start'] = time();
$_SESSION['challenge_duration'] = 120; // 120 detik total (2 menit)

header("Location: challenge_play.php?page=0");
exit;
?>
