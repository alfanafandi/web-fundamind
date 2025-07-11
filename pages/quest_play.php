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

// Ambil semua soal untuk chapter ini
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

// Inisialisasi session data soal
if (!isset($_SESSION[$session_key]) || $_SESSION[$session_key]['id_chapter'] != $id_chapter) {
    $_SESSION[$session_key] = [
        'index' => 0,
        'answers' => [],
        'use_hint' => false,
        'feedback' => [],
        'id_chapter' => $id_chapter
    ];
}

// Gunakan Insight Orb
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_insight_orb'])) {
    $_SESSION[$session_key]['use_hint'] = true;
    mysqli_query($koneksi, "
        UPDATE user_items SET jumlah = jumlah - 1 
        WHERE id_user = $user_id 
        AND id_item = (SELECT id_item FROM shop_items WHERE nama_item = 'Insight Orb') 
        AND jumlah > 0 LIMIT 1
    ");
    $_SESSION['notifikasi_item'] = 'Petunjuk aktif dari Insight Orb!';
    header("Location: quest_play.php?id_chapter=$id_chapter" . ($is_replay ? "&replay=1" : ""));
    exit;
}

// Gunakan Knowledge Scroll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_scroll'])) {
    mysqli_query($koneksi, "
        UPDATE user_items SET jumlah = jumlah - 1 
        WHERE id_user = $user_id 
        AND id_item = (SELECT id_item FROM shop_items WHERE nama_item = 'Knowledge Scroll') 
        AND jumlah > 0 LIMIT 1
    ");
    mysqli_query($koneksi, "UPDATE users SET xp = xp + 15 WHERE id_user = $user_id");
    $_SESSION['notifikasi_item'] = '+15 XP dari Knowledge Scroll!';
    header("Location: quest_play.php?id_chapter=$id_chapter" . ($is_replay ? "&replay=1" : ""));
    exit;
}

// Gunakan Portal Pass
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_portal'])) {
    mysqli_query($koneksi, "
        UPDATE user_items SET jumlah = jumlah - 1 
        WHERE id_user = $user_id 
        AND id_item = (SELECT id_item FROM shop_items WHERE nama_item = 'Portal Pass') 
        AND jumlah > 0 LIMIT 1
    ");
    $_SESSION[$session_key]['index']++;
    $_SESSION['notifikasi_item'] = 'Satu soal dilewati dengan Portal Pass!';
    header("Location: quest_play.php?id_chapter=$id_chapter" . ($is_replay ? "&replay=1" : ""));
    exit;
}

// Proses jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_SESSION[$session_key]['index'];

    if (isset($_POST['jawaban'])) {
        $jawaban = strtolower($_POST['jawaban']);
        $_SESSION[$session_key]['answers'][$index] = $jawaban;

        $correct_answer = strtolower($questions[$index]['jawaban_benar']);
        $benar = $jawaban === $correct_answer;

        $_SESSION[$session_key]['feedback'][$index] = [
            'benar' => $benar,
            'petunjuk' => $questions[$index]['petunjuk'] ?? '',
        ];

        if ($benar) {
            $_SESSION[$session_key]['index']++;
            header("Location: quest_play.php?id_chapter=$id_chapter" . ($is_replay ? "&replay=1" : ""));
            exit;
        }
    }

    if (isset($_POST['lanjutkan'])) {
        $_SESSION[$session_key]['index']++;
        $_SESSION[$session_key]['use_hint'] = false;
        header("Location: quest_play.php?id_chapter=$id_chapter" . ($is_replay ? "&replay=1" : ""));
        exit;
    }
}

// Cek apakah soal habis
$current_index = $_SESSION[$session_key]['index'];
if ($current_index >= $total_questions) {
    $redirect = "quest_result.php?id_chapter=$id_chapter";
    if ($is_replay) $redirect .= "&replay=1";
    header("Location: $redirect");
    exit;
}

// Ambil soal saat ini
$current_question = $questions[$current_index] ?? null;
$feedback = $_SESSION[$session_key]['feedback'][$current_index] ?? null;
$current_answer = $_SESSION[$session_key]['answers'][$current_index] ?? null;

// Ambil item user
$item_query = mysqli_query($koneksi, "
    SELECT si.*, ui.jumlah 
    FROM user_items ui 
    JOIN shop_items si ON ui.id_item = si.id_item 
    WHERE ui.id_user = $user_id AND ui.jumlah > 0
");
$user_items = [];
while ($row = mysqli_fetch_assoc($item_query)) {
    $user_items[] = $row;
}
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

        .alert-info,
        .alert-warning,
        .alert-success {
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
            <div class="text-end">
                <button class="btn btn-sm btn-dark mb-3" data-bs-toggle="modal" data-bs-target="#modalItem">🎒 Lihat Item</button>
            </div>

            <?php if (isset($_SESSION['notifikasi_item'])): ?>
                <div class="alert alert-success text-center">
                    <?= $_SESSION['notifikasi_item']; unset($_SESSION['notifikasi_item']); ?>
                </div>
            <?php endif; ?>

            <h5 class="card-title">Soal <?= $current_index + 1 ?> dari <?= $total_questions ?></h5>
            <p class="question-text"><?= htmlspecialchars($current_question['pertanyaan']) ?></p>

            <?php if ($_SESSION[$session_key]['use_hint'] && !empty($current_question['petunjuk'])): ?>
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
                            <input type="radio" name="jawaban" value="<?= $opt ?>" required onchange="this.form.submit();">
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

<!-- Modal Item -->
<div class="modal fade" id="modalItem" tabindex="-1" aria-labelledby="modalItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning-subtle">
                <h5 class="modal-title">🎒 Daftar Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <?php if (empty($user_items)): ?>
                        <div class="col-12 text-center text-muted">Kamu belum punya item apapun.</div>
                    <?php else: ?>
                        <?php foreach ($user_items as $item): ?>
                            <div class="col-md-4">
                                <div class="border rounded p-3 bg-light h-100 text-center">
                                    <img src="../assets/images/<?= $item['file_icon'] ?>" height="40"><br>
                                    <strong><?= $item['nama_item'] ?></strong>
                                    <p class="small mb-1"><?= $item['deskripsi'] ?></p>
                                    <p class="small text-muted">Jumlah: <?= $item['jumlah'] ?></p>

                                    <?php if ($item['nama_item'] === 'Insight Orb' && !$_SESSION[$session_key]['use_hint']): ?>
                                        <form method="POST">
                                            <input type="hidden" name="use_insight_orb" value="1">
                                            <button class="btn btn-sm btn-warning">Gunakan</button>
                                        </form>
                                    <?php elseif ($item['nama_item'] === 'Knowledge Scroll'): ?>
                                        <form method="POST">
                                            <input type="hidden" name="use_scroll" value="1">
                                            <button class="btn btn-sm btn-success">+15 XP</button>
                                        </form>
                                    <?php elseif ($item['nama_item'] === 'Portal Pass'): ?>
                                        <form method="POST">
                                            <input type="hidden" name="use_portal" value="1">
                                            <button class="btn btn-sm btn-primary">Lewati Soal</button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-secondary" disabled>⛔ Tidak dapat digunakan</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
