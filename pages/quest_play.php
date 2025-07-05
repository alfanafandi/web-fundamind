<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id_chapter = $_GET['id_chapter'] ?? 0;

$result = mysqli_query($koneksi, "SELECT * FROM quest_questions WHERE id_chapter = $id_chapter ORDER BY id_question ASC");
$questions = [];
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}
$total_questions = count($questions);

if ($total_questions === 0) {
    echo "<div class='alert alert-danger text-center mt-5'>Soal tidak ditemukan.</div>";
    exit;
}

// Cek Magnifying Glass
$has_magnifying = false;
$magnifying_check = mysqli_query($koneksi, "SELECT id_user FROM user_items WHERE id_user = $user_id AND nama_item = 'Magnifying Glass' LIMIT 1");
if ($item = mysqli_fetch_assoc($magnifying_check)) {
    $has_magnifying = true;
}

if (!isset($_SESSION['question_data']) || $_SESSION['question_data']['id_chapter'] != $id_chapter) {
    $_SESSION['question_data'] = [
        'index' => 0,
        'answers' => [],
        'use_magnifying' => false,
        'feedback' => [],
        'id_chapter' => $id_chapter
    ];
}

if (isset($_POST['use_magnifying']) && $has_magnifying && !$_SESSION['question_data']['use_magnifying']) {
    $_SESSION['question_data']['use_magnifying'] = true;
    mysqli_query($koneksi, "DELETE FROM user_items WHERE id_user = $user_id AND nama_item = 'Magnifying Glass' LIMIT 1");
    header("Location: quest_play.php?id_chapter=$id_chapter");
    exit;
}

// Proses jawaban atau lanjutkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_SESSION['question_data']['index'];

    if (isset($_POST['jawaban'])) {
        $jawaban = strtolower($_POST['jawaban']);
        $_SESSION['question_data']['answers'][$index] = $jawaban;

        $correct_answer = strtolower($questions[$index]['jawaban_benar']);
        $benar = $jawaban === $correct_answer;

        $_SESSION['question_data']['feedback'][$index] = [
            'benar' => $benar,
            'petunjuk' => $questions[$index]['petunjuk'] ?? '',
        ];

        if ($benar) {
            $_SESSION['question_data']['index']++;
            header("Location: quest_play.php?id_chapter=$id_chapter");
            exit;
        }
    }

    if (isset($_POST['lanjutkan'])) {
        $_SESSION['question_data']['index']++;
        header("Location: quest_play.php?id_chapter=$id_chapter");
        exit;
    }
}

$current_index = $_SESSION['question_data']['index'];

// ✅ Redirect jika soal sudah habis
if ($current_index >= $total_questions) {
    header("Location: quest_result.php?id_chapter=$id_chapter");
    exit;
}

$current_question = $questions[$current_index] ?? null;
$feedback = $_SESSION['question_data']['feedback'][$current_index] ?? null;
$current_answer = $_SESSION['question_data']['answers'][$current_index] ?? null;
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kerjakan Quest</title>
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
            padding-top: 55px;
            color: #3e2b13;
        }

        .quest-card {
            background: rgba(255, 248, 200, 0.92);
            border: 4px solid #a77b3b;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.4);
            max-width: 900px;
            margin: 0 auto;
        }

        .card-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #4a3513;
            margin-bottom: 15px;
        }

        .question-text {
            font-size: 1.25rem;
            margin-bottom: 20px;
        }

        .choice-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .choice-card {
            background: #f7e6b1;
            border: 2px solid #a77b3b;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.2rem;
            cursor: pointer;
            transition: 0.2s;
        }

        .choice-card:hover {
            background: #e5d296;
            transform: scale(1.02);
        }

        .choice-card.bg-success {
            background-color: #c8e6c9;
            border-color: #388e3c;
        }

        .choice-card.bg-danger {
            background-color: #ffcdd2;
            border-color: #c62828;
        }

        input[type="radio"] {
            display: none;
        }

        .btn-warning {
            background-color: #d8a900;
            border-color: #c59700;
            color: #fff;
            font-weight: bold;
        }

        .btn-warning:hover {
            background-color: #c59700;
        }

        .alert-info,
        .alert-warning {
            background-color: #f3e7c3;
            border-color: #c2a962;
            color: #3e3214;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container mt-5">
        <div class="quest-card">
            <div class="card-body">
                <h5 class="card-title">Soal <?= $current_index + 1 ?> dari <?= $total_questions ?></h5>
                <p class="question-text"><?= htmlspecialchars($current_question['pertanyaan']) ?></p>

                <?php if (!$has_magnifying): ?>
                    <div class="alert alert-warning">Kamu tidak punya item <strong>Magnifying Glass</strong>.</div>
                <?php elseif (!$_SESSION['question_data']['use_magnifying']): ?>
                    <form method="POST" class="mb-3">
                        <button type="submit" name="use_magnifying" class="btn btn-warning">🔍 Gunakan Magnifying Glass</button>
                    </form>
                <?php elseif (!empty($current_question['petunjuk'])): ?>
                    <div class="alert alert-info"><strong>Petunjuk:</strong> <?= htmlspecialchars($current_question['petunjuk']) ?></div>
                <?php endif; ?>

                <?php if ($feedback && !$feedback['benar'] && !empty($feedback['petunjuk'])): ?>
                    <div class="alert alert-info"><strong>Petunjuk:</strong> <?= htmlspecialchars($feedback['petunjuk']) ?></div>
                <?php endif; ?>

                <form method="POST" id="form-jawaban">
                    <div class="choice-grid">
                        <?php foreach (['a', 'b', 'c', 'd'] as $opt): ?>
                            <?php
                            $kelas = '';
                            if ($current_answer === $opt && $feedback) {
                                $kelas = $feedback['benar'] ? 'bg-success' : 'bg-danger';
                            }
                            ?>
                            <label>
                                <input type="radio" name="jawaban" id="jawaban_<?= $opt ?>" value="<?= $opt ?>" required onchange="this.form.submit();">
                                <div class="choice-card <?= $kelas ?>">
                                    <?= htmlspecialchars($current_question["pilihan_$opt"]) ?>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </form>

                <?php if ($feedback && !$feedback['benar']): ?>
                    <form method="POST" class="text-center mt-3">
                        <button type="submit" name="lanjutkan" class="btn btn-primary">Lanjutkan ➡️</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
