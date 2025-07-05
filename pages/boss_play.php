<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$id_boss = $_GET['id_boss'] ?? 0;

// Reset sesi jika boss berbeda
if (!isset($_SESSION['boss_id']) || $_SESSION['boss_id'] != $id_boss) {
    unset($_SESSION['boss_questions'], $_SESSION['boss_current'], $_SESSION['boss_answers']);
    $_SESSION['boss_id'] = $id_boss;
}

// Ambil data boss
$queryBoss = mysqli_query($koneksi, "
    SELECT b.*, q.judul AS judul_quest 
    FROM boss_unlock_requirements b
    JOIN quests q ON b.id_quest = q.id_quest
    WHERE b.id_boss = $id_boss
");
$boss = mysqli_fetch_assoc($queryBoss);

if (!$boss) {
    echo "Boss tidak ditemukan.";
    exit;
}

$bg_image = '../assets/images/' . $boss['background_image'];
$boss_image = '../assets/images/' . $boss['boss_image'];

// Cek apakah user sudah menang lawan boss (semua benar)
$cek_result = mysqli_query($koneksi, "
    SELECT * FROM boss_results 
    WHERE id_user = $id_user AND id_boss = $id_boss AND jumlah_benar = total_soal
");
if (mysqli_num_rows($cek_result) > 0) {
    header("Location: boss_result.php?id_boss=$id_boss");
    exit;
}

// Ambil daftar soal jika belum ada di sesi
if (!isset($_SESSION['boss_questions']) || !isset($_SESSION['boss_current']) || !isset($_SESSION['boss_answers'])) {
    $questionIds = [];
    $questions = mysqli_query($koneksi, "SELECT id_question FROM boss_questions WHERE id_boss = $id_boss");
    while ($q = mysqli_fetch_assoc($questions)) {
        $questionIds[] = $q['id_question'];
    }

    shuffle($questionIds);
    $_SESSION['boss_questions'] = $questionIds;
    $_SESSION['boss_current'] = 0;
    $_SESSION['boss_answers'] = [];
}

$currentIndex = $_SESSION['boss_current'];
$questionIds = $_SESSION['boss_questions'];

if ($currentIndex >= count($questionIds)) {
    header("Location: boss_result.php?id_boss=$id_boss");
    exit;
}

$currentQuestionId = $questionIds[$currentIndex];
$questionData = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT * FROM boss_questions 
    WHERE id_question = $currentQuestionId AND id_boss = $id_boss
"));

if (!$questionData) {
    echo "<div style='color:red;text-align:center;'>Soal tidak ditemukan.</div>";
    exit;
}

// Proses jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jawaban = $_POST['jawaban'] ?? '';
    $_SESSION['boss_answers'][] = [
        'id_question' => $currentQuestionId,
        'jawaban' => $jawaban
    ];
    $_SESSION['boss_current']++;

    if ($_SESSION['boss_current'] >= count($_SESSION['boss_questions'])) {
        header("Location: boss_result.php?id_boss=$id_boss");
    } else {
        header("Location: boss_play.php?id_boss=$id_boss");
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pertarungan Boss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            background-image: url('<?= $bg_image ?>');
            background-size: cover;
            background-position: center;
            font-family: 'PixelifySans', sans-serif;
            color: #3b2606;
            padding-top: 80px;
        }

        .battle-box {
            background-color: rgba(255, 248, 220, 0.95);
            border: 4px solid #a77b3b;
            border-radius: 24px;
            padding: 30px;
            max-width: 850px;
            margin: auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .boss-image {
            width: 130px;
            margin-bottom: 15px;
        }

        .question {
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: center;
        }

        .choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .choice-card {
            background-color: #fff4dd;
            border: 2px solid #cc9944;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s ease-in-out, background 0.3s;
        }

        .choice-card:hover {
            background-color: #f9ddb0;
            transform: scale(1.03);
        }

        .submit-btn {
            background-color: #b13d3d;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .submit-btn:hover {
            background-color: #912f2f;
        }

        input[type=radio] {
            display: none;
        }

        input[type=radio]:checked + .choice-card {
            background-color: #ffe0b3;
            border: 3px solid #a95a1c;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="battle-box">
        <div class="text-center">
            <img src="<?= $boss_image ?>" alt="Boss" class="boss-image">
        </div>
        <form method="POST">
            <div class="question"><?= htmlspecialchars($questionData['pertanyaan']) ?></div>

            <div class="choices">
                <?php foreach (['a', 'b', 'c', 'd'] as $opt): ?>
                    <label>
                        <input type="radio" name="jawaban" value="<?= $opt ?>" required>
                        <div class="choice-card">
                            <?= strtoupper($opt) ?>. <?= htmlspecialchars($questionData['pilihan_' . $opt]) ?>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="submit-btn">Kirim Jawaban</button>
            </div>
        </form>
    </div>
</body>
</html>