<?php
session_start();

if (!isset($_POST['answer']) || !isset($_POST['page'])) {
    header("Location: challenge_play.php?page=0");
    exit;
}

$page = (int)$_POST['page'];
$answer = $_POST['answer'];

$_SESSION['challenge_answers'][$page] = $answer;

header("Location: challenge_play.php?page=" . ($page + 1));
exit;

// Simpan data ke challenge_data
$_SESSION['challenge_data'] = [
    'answers' => $_SESSION['challenge_answers'],
    'start_time' => $_SESSION['challenge_start_time']
];

header("Location: challenge_result.php");
exit;
?>
