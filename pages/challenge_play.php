<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$today = date('Y-m-d');
// Cek apakah user sudah mengerjakan challenge hari ini
$cek = mysqli_query($koneksi, "SELECT last_challenge_date FROM users WHERE id_user = $user_id");
$last_data = mysqli_fetch_assoc($cek);

if ($last_data['last_challenge_date'] === $today) {
?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Challenge Sudah Dikerjakan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/navbar.css">
        <style>
            @font-face {
                font-family: "PixelifySans";
                src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
            }

            body {
                background-image: url('../assets/images/guild_background_1440x1024.png');
                background-size: cover;
                background-position: center;
                font-family: 'PixelifySans', sans-serif;
                color: #2e1d0f;
                padding-top: 60px;
            }

            .finished-box {
                max-width: 700px;
                background: rgba(255, 255, 255, 0.95);
                margin: 100px auto;
                padding: 40px;
                border-radius: 20px;
                text-align: center;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            }

            .btn-back {
                background-color: #f4c542;
                color: #3e2b13;
                font-weight: bold;
                padding: 10px 25px;
                border-radius: 10px;
                border: none;
                text-decoration: none;
            }

            .btn-back:hover {
                background-color: #e0b838;
            }
        </style>
    </head>

    <body>
        <?php include 'includes/navbar.php'; ?>
        <div class="finished-box">
            <h2>🎉 Kamu sudah menyelesaikan Challenge hari ini!</h2>
            <p>Tantangan berikutnya akan tersedia besok.</p>
            <a href="quest_box.php" class="btn-back mt-3">⬅️ Kembali ke Kotak Quest</a>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php
    exit;
}

// Gunakan Chrono Clock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['use_chrono'])) {
    $_SESSION['challenge_bonus_time'] = ($_SESSION['challenge_bonus_time'] ?? 0) + 30;
    mysqli_query($koneksi, "
        UPDATE user_items SET jumlah = jumlah - 1 
        WHERE id_user = $user_id 
        AND id_item = (SELECT id_item FROM shop_items WHERE nama_item = 'Chrono Clock') 
        AND jumlah > 0 LIMIT 1
    ");
    $_SESSION['notifikasi_item'] = '+30 detik dari Chrono Clock!';
    header("Location: challenge_play.php");
    exit;
}

// Ambil level user
$user_data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT level FROM users WHERE id_user = $user_id"));
$level_user = $user_data['level'] ?? 1;

// Jika sesi soal belum ada, generate
if (!isset($_SESSION['challenge_questions'])) {
    $result = mysqli_query($koneksi, "SELECT * FROM quest_questions WHERE min_level <= $level_user ORDER BY RAND() LIMIT 10");
    $questions = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $questions[] = $row;
    }

    if (count($questions) === 0) {
        echo "<div class='alert alert-danger text-center mt-5'>Tidak ada soal Challenge tersedia untuk levelmu.</div>";
        exit;
    }

    $_SESSION['challenge_questions'] = $questions;
    $_SESSION['challenge_answers'] = [];
    $_SESSION['challenge_index'] = 0;
    $_SESSION['challenge_start_time'] = time();
    $_SESSION['challenge_bonus_time'] = 0;
}

$questions = $_SESSION['challenge_questions'];
$index = $_SESSION['challenge_index'] ?? 0;
$total = count($questions);

// Proses jawaban
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['jawaban'])) {
    $jawaban_user = $_POST['jawaban'] ?? '';
    $current_qid = $questions[$index]['id_question'];
    $_SESSION['challenge_answers'][$current_qid] = $jawaban_user;

    $_SESSION['challenge_index']++;

    if ($_SESSION['challenge_index'] >= $total) {
        $_SESSION['challenge_data'] = [
            'answers' => $_SESSION['challenge_answers'],
            'start_time' => $_SESSION['challenge_start_time']
        ];
        header("Location: challenge_result.php");
        exit;
    }

    header("Location: challenge_play.php");
    exit;
}

$current_question = $questions[$index];

// Ambil item
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
    <title>Challenge Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            background-image: url('../assets/images/guild_background_1440x1024.png');
            background-size: cover;
            font-family: 'PixelifySans', sans-serif;
            color: #2e1d0f;
            padding-top: 60px;
        }

        .card-question {
            background-color: rgba(255, 248, 220, 0.95);
            border: 4px solid #a77b3b;
            border-radius: 16px;
            padding: 30px;
            max-width: 800px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: bold;
            color: #4a3513;
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

        input[type="radio"] {
            display: none;
        }

        .btn-timer {
            font-weight: bold;
            color: #a4161a;
            text-align: right;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container mt-4">
        <div class="card-question">
            <div class="btn-timer mb-2">
                ⏱️ Waktu: <span id="timer">--:--</span>
            </div>

            <?php if (isset($_SESSION['notifikasi_item'])): ?>
                <div class="alert alert-info text-center">
                    <strong><?= $_SESSION['notifikasi_item'];
                            unset($_SESSION['notifikasi_item']); ?></strong>
                </div>
            <?php endif; ?>

            <div class="card-title">Soal <?= $index + 1 ?> dari <?= $total ?></div>
            <p class="mb-4"><?= nl2br(htmlspecialchars($current_question['pertanyaan'] ?? '-')) ?></p>

            <form method="post" id="formJawaban">
                <div class="choice-grid">
                    <?php foreach (['a', 'b', 'c', 'd'] as $opt): ?>
                        <?php if (isset($current_question['pilihan_' . $opt])): ?>
                            <label>
                                <input type="radio" name="jawaban" value="<?= $opt ?>" onchange="document.getElementById('formJawaban').submit();">
                                <div class="choice-card"><?= htmlspecialchars($current_question['pilihan_' . $opt]) ?></div>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </form>

            <div class="text-center mt-4">
                <button class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modalItem">🎒 Lihat Item</button>
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

                                        <?php if ($item['nama_item'] === 'Chrono Clock'): ?>
                                            <form method="POST">
                                                <input type="hidden" name="use_chrono" value="1">
                                                <button class="btn btn-sm btn-info">+30 Detik</button>
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

    <script>
        const startTime = <?= $_SESSION['challenge_start_time'] ?? time() ?>;
        const bonusTime = <?= $_SESSION['challenge_bonus_time'] ?? 0 ?>;
        const now = Math.floor(Date.now() / 1000);
        let totalSeconds = Math.max(0, 180 + bonusTime - (now - startTime));

        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const minutes = Math.floor(totalSeconds / 60);
            const seconds = totalSeconds % 60;
            timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            if (totalSeconds > 0) {
                totalSeconds--;
            } else {
                clearInterval(timerInterval);
                alert("⏰ Waktu habis! Challenge akan langsung diselesaikan.");
                window.location.href = "challenge_result.php";
            }
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>