<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_boss = $_GET['id_boss'] ?? 0;

// Cek apakah hasil sudah pernah disimpan
$cek_result = mysqli_query($koneksi, "
    SELECT * FROM boss_results 
    WHERE id_user = $id_user AND id_boss = $id_boss
");

if (mysqli_num_rows($cek_result) > 0) {
    $result = mysqli_fetch_assoc($cek_result);
    $correct = $result['jumlah_benar'];
    $total = $result['total_soal'];
    $xp_reward = $result['xp_didapat'];
    $coin_reward = $result['coin_didapat'];
    $feedbacks = [];

    $pesan = ($correct === $total)
        ? "🎉 Kamu sudah mengalahkan boss ini dan mendapatkan <strong>$xp_reward XP</strong> dan <strong>$coin_reward Koin</strong>."
        : "😢 Kamu belum berhasil mengalahkan boss sebelumnya. Coba lagi untuk dapat reward!";
} else {
    if (!isset($_SESSION['boss_questions'], $_SESSION['boss_answers'])) {
        header("Location: boss_play.php?id_boss=$id_boss");
        exit;
    }

    $questions = $_SESSION['boss_questions'];
    $answers = $_SESSION['boss_answers'];
    $correct = 0;
    $total = count($questions);
    $feedbacks = [];

    foreach ($answers as $entry) {
        $qid = $entry['id_question'];
        $jawaban_user = $entry['jawaban'];
        $q = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM boss_questions WHERE id_question = $qid"));
        $jawaban_benar = $q['jawaban_benar'];
        $benar = ($jawaban_user === $jawaban_benar);
        if ($benar) $correct++;

        $feedbacks[] = [
            'pertanyaan' => $q['pertanyaan'],
            'jawaban_user' => $jawaban_user,
            'jawaban_benar' => $jawaban_benar,
            'petunjuk' => $q['petunjuk'],
            'pilihan' => [
                'a' => $q['pilihan_a'],
                'b' => $q['pilihan_b'],
                'c' => $q['pilihan_c'],
                'd' => $q['pilihan_d']
            ],
            'benar' => $benar
        ];
    }

    // Ambil reward dari boss
    $boss = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT xp_reward, coin_reward 
        FROM boss_quests 
        WHERE id_boss = $id_boss
    "));

    if ($correct === $total) {
        $xp_reward = $boss['xp_reward'];
        $coin_reward = $boss['coin_reward'];

        // Tambahkan XP dan coin ke user
        mysqli_query($koneksi, "
            UPDATE users 
            SET xp = xp + $xp_reward, coin = coin + $coin_reward 
            WHERE id_user = $id_user
        ");

        $pesan = "🎉 Kamu mendapatkan <strong>$xp_reward XP</strong> dan <strong>$coin_reward Koin</strong>!";
    } else {
        $xp_reward = 0;
        $coin_reward = 0;
        $pesan = "😢 Kamu belum berhasil mengalahkan boss. Coba lagi lain waktu!";
    }

    // Simpan hanya jika semua jawaban benar
    if ($correct === $total) {
        mysqli_query($koneksi, "
        INSERT INTO boss_results (id_user, id_boss, jumlah_benar, total_soal, xp_didapat, coin_didapat)
        VALUES ($id_user, $id_boss, $correct, $total, $xp_reward, $coin_reward)
    ");
    }


    // Bersihkan sesi boss
    unset($_SESSION['boss_questions'], $_SESSION['boss_answers'], $_SESSION['boss_current']);

    // Cek dan naikkan level jika memenuhi
    $user_info = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT xp, level, xp_next FROM users WHERE id_user = $id_user
    "));
    $current_xp = $user_info['xp'];
    $current_level = $user_info['level'];
    $xp_next = $user_info['xp_next'];

    while ($current_xp >= $xp_next) {
        $current_xp -= $xp_next;
        $current_level++;
        $xp_next = $current_level * 100;

        mysqli_query($koneksi, "
            UPDATE users 
            SET level = $current_level, xp = $current_xp, xp_next = $xp_next 
            WHERE id_user = $id_user
        ");
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pertarungan Boss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf");
        }

        body {
            font-family: 'PixelifySans', sans-serif;
            background-image: url('../assets/images/bg_boss_result.png');
            background-size: cover;
            background-position: center;
            padding-top: 70px;
            color: #2e1d0f;
        }

        .result-box {
            background-color: rgba(255, 250, 230, 0.95);
            border: 4px solid #d4a246;
            border-radius: 22px;
            padding: 40px;
            max-width: 900px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .question-feedback {
            background-color: #fff8dd;
            border: 2px solid #caa84a;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .benar {
            border-left: 6px solid green;
        }

        .salah {
            border-left: 6px solid red;
        }

        .reward {
            font-size: 1.2rem;
            margin-top: 20px;
            text-align: center;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 1.1rem;
            border-radius: 12px;
            display: block;
            width: fit-content;
            margin: 30px auto 0;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #4e555b;
        }

        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="result-box">
        <h2>🏆 Hasil Pertarungan Boss</h2>
        <p class="text-center">Kamu menjawab <strong><?= $correct ?></strong> dari <strong><?= $total ?></strong> soal dengan benar.</p>

        <div class="reward"><?= $pesan ?></div>
        <a href="quest_boss.php" class="btn-back">← Kembali ke Daftar Boss</a>
    </div>
</body>

</html>