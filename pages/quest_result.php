<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id_chapter = $_GET['id_chapter'] ?? 0;
$is_replay = isset($_GET['replay']) && $_GET['replay'] == 1;
$session_key = $is_replay ? 'question_data_replay' : 'question_data';

$question_data = $_SESSION[$session_key] ?? null;
$nilai = 0;
$xp_real = 0;
$coin_real = 0;

// Ambil data reward chapter
$chapter_info = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT id_quest, xp_reward, coin_reward 
    FROM quest_chapters 
    WHERE id_chapter = $id_chapter
"));
$id_progress = $chapter_info['id_quest'] ?? 0;
$xp_reward = $chapter_info['xp_reward'] ?? 0;
$coin_reward = $chapter_info['coin_reward'] ?? 0;

if ($question_data && $question_data['id_chapter'] == $id_chapter) {
    // Proses penilaian
    $result = mysqli_query($koneksi, "SELECT * FROM quest_questions WHERE id_chapter = $id_chapter ORDER BY id_question ASC");
    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }

    $total_questions = count($questions);
    $benar = 0;

    foreach ($questions as $i => $q) {
        $id_q = $q['id_question'];
        $user_answer = strtolower($question_data['answers'][$i] ?? '');
        $correct_answer = strtolower($q['jawaban_benar']);
        if ($user_answer === $correct_answer) $benar++;

        // Tetap simpan jawaban
        mysqli_query($koneksi, "REPLACE INTO user_answers 
            (id_user, id_chapter, id_question, jawaban_user) 
            VALUES ($user_id, $id_chapter, $id_q, '$user_answer')");
    }

    $nilai = round(($benar / max(1, $total_questions)) * 100);
    $xp_min = 20;
    $xp_real = max($xp_min, round($xp_reward * ($benar / max(1, $total_questions))));
    $coin_real = floor($coin_reward * ($benar / max(1, $total_questions)));

    // Jika replay, kurangi reward
    if ($is_replay) {
        $xp_real = floor($xp_real * 0.5);
        $coin_real = floor($coin_real * 0.5);
    }

    // Tambahkan ke akun
    mysqli_query($koneksi, "
        UPDATE users SET xp = xp + $xp_real, coin = coin + $coin_real WHERE id_user = $user_id
    ");

    // Cek level up
    $user_info = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT xp, level, xp_next FROM users WHERE id_user = $user_id"));
    $xp = $user_info['xp'];
    $level = $user_info['level'];
    $xp_next = $user_info['xp_next'];

    while ($xp >= $xp_next) {
        $xp -= $xp_next;
        $level++;
        $xp_next = $level * 100;
        mysqli_query($koneksi, "UPDATE users SET level = $level, xp = $xp, xp_next = $xp_next WHERE id_user = $user_id");
    }

    // Simpan progress ke tabel progress utama hanya jika bukan replay
    if (!$is_replay) {
        $waktu_selesai = date('Y-m-d H:i:s');
        mysqli_query($koneksi, "
            INSERT INTO user_chapter_progress 
            (id_progress, id_user, id_chapter, nilai, sudah_selesai, waktu_selesai, xp_didapat, coin_didapat)
            VALUES 
            ($id_progress, $user_id, $id_chapter, $nilai, 1, '$waktu_selesai', $xp_real, $coin_real)
            ON DUPLICATE KEY UPDATE 
                nilai = VALUES(nilai),
                sudah_selesai = 1,
                waktu_selesai = VALUES(waktu_selesai),
                xp_didapat = VALUES(xp_didapat),
                coin_didapat = VALUES(coin_didapat)
        ");
    }

    unset($_SESSION[$session_key]);
} else {
    // Ambil dari progress jika tidak sedang menjawab ulang
    $progress = mysqli_fetch_assoc(mysqli_query($koneksi, "
        SELECT * FROM user_chapter_progress 
        WHERE id_user = $user_id AND id_chapter = $id_chapter
    "));
    if (!$progress) {
        echo "<div class='alert alert-danger text-center mt-5'>Kamu belum menyelesaikan quest ini.</div>";
        exit;
    }

    $nilai = $progress['nilai'];
    $xp_real = $progress['xp_didapat'];
    $coin_real = $progress['coin_didapat'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css" />
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            font-family: "PixelifySans", sans-serif;
            background-color: #0b122b;
            background-image: url("../assets/images/guild_background_1440x1024.png");
            background-size: cover;
            background-position: center;
            padding-top: 60px;
            color: #2e1d0f;
        }

        .result-card {
            background: rgba(255, 248, 220, 0.95);
            border: 4px solid #a77b3b;
            border-radius: 18px;
            padding: 40px;
            max-width: 720px;
            margin: 0 auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
            text-align: center;
        }

        h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
            color: #4b3210;
        }

        .score {
            font-size: 3.5rem;
            font-weight: bold;
            color: #1e5e00;
        }

        .reward {
            font-size: 1.3rem;
            color: #5b3c11;
            margin-top: 10px;
        }

        .btn-custom {
            background-color: #d8a900;
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 10px;
            font-size: 1.1rem;
        }

        .btn-custom:hover {
            background-color: #c59700;
        }

        .mt-5 {
            margin-top: 4rem !important;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="result-card mt-5">
            <h1>🎉 Hasil Quest</h1>
            <p class="score"><?= $nilai ?> / 100</p>
            <p class="reward">+<?= $xp_real ?> XP &nbsp; | &nbsp; +<?= $coin_real ?> Coin</p>

            <?php if ($is_replay): ?>
                <div class="alert alert-info mt-3">
                    <strong>Replay Mode:</strong> XP dan Coin tetap diberikan namun dikurangi (50% dari reward awal).
                </div>
            <?php endif; ?>

            <a href="quest_chapter.php?id_quest=<?= $id_progress ?>" class="btn btn-custom mt-4">⬅️ Kembali ke Daftar Chapter</a>
        </div>
    </div>
</body>
</html>
