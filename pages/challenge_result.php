<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['challenge_data'])) {
    echo "<div class='text-center mt-5 text-danger'>Tidak ada data Challenge ditemukan.</div>";
    exit;
}

$user_id = $_SESSION['user_id'];
$challenge_data = $_SESSION['challenge_data'];

$answers = $challenge_data['answers'];
$start_time = $challenge_data['start_time'];
$end_time = time();
$duration = $end_time - $start_time;

$question_ids = implode(",", array_map('intval', array_keys($answers)));
$result = mysqli_query($koneksi, "SELECT id_question, jawaban_benar FROM quest_questions WHERE id_question IN ($question_ids)");

$correct = 0;
$total = count($answers);
while ($row = mysqli_fetch_assoc($result)) {
    $qid = $row['id_question'];
    if (strtolower($answers[$qid]) === strtolower($row['jawaban_benar'])) {
        $correct++;
    }
}

$score = round(($correct / $total) * 100);
$duration_str = gmdate("i:s", $duration);

// 🎁 Hitung reward (skema Challenge)
$xp = $score;              // Misal 100 skor → 100 XP
$coin = floor($score / 5); // Misal 100 skor → 20 koin

// ✅ Tambahkan XP & Coin sementara
mysqli_query($koneksi, "UPDATE users SET xp = xp + $xp, coin = coin + $coin WHERE id_user = $user_id");

// 🔄 Ambil data terbaru user
$user_result = mysqli_query($koneksi, "SELECT xp, level FROM users WHERE id_user = $user_id");
$user = mysqli_fetch_assoc($user_result);

$current_xp = $user['xp'];
$current_level = $user['level'];
$xp_needed = $current_level * 100;

// 🔼 Cek apakah bisa naik level
while ($current_xp >= $xp_needed) {
    $current_xp -= $xp_needed;
    $current_level++;
    $xp_needed = $current_level * 100;
}

// ✅ Simpan level dan XP baru
mysqli_query($koneksi, "UPDATE users SET level = $current_level, xp = $current_xp WHERE id_user = $user_id");

// ✅ Simpan waktu challenge terakhir
$_SESSION['last_challenge_date'] = date('Y-m-d');


// ✅ Bersihkan sesi challenge
unset($_SESSION['challenge_data']);
unset($_SESSION['challenge_questions']);
unset($_SESSION['challenge_answers']);
unset($_SESSION['challenge_index']);
unset($_SESSION['challenge_start_time']);

// Simpan skor ke challenge_scores

mysqli_query($koneksi, "INSERT INTO challenge_scores (id_user, score) VALUES ($user_id, $score)");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            background: url('../assets/images/guild_background_1440x1024.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'PixelifySans', sans-serif;
            padding-top: 60px;
            color: #fff;
        }

        .result-card {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            max-width: 700px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: #2e1d0f;
        }

        .score {
            font-size: 3rem;
            color: #2c7713;
        }

        .reward-box {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #3e2b13;
            background-color: #f7e8c3;
            border: 2px dashed #d7a84b;
            padding: 15px;
            border-radius: 15px;
        }

        .btn-custom {
            background-color: #f4c542;
            border: none;
            color: #3e2b13;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-custom:hover {
            background-color: #e0b838;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container">
        <div class="result-card mt-5">
            <h1>🎯 Hasil Challenge</h1>
            <p class="score"><?= $score ?> / 100</p>
            <p><strong>Benar:</strong> <?= $correct ?> dari <?= $total ?> soal</p>
            <p><strong>Waktu:</strong> <?= $duration_str ?> menit:detik</p>

            <div class="reward-box mt-4">
                🎁 <strong>Reward:</strong><br>
                +<?= $xp ?> XP<br>
                +<?= $coin ?> Koin
            </div>

            <div class="mt-4">
                <a href="quest_box.php" class="btn btn-custom">⬅️ Kembali ke Kotak Quest</a>
            </div>
        </div>
    </div>
</body>
</html>
