<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$quest_id = $_GET['id'] ?? $_GET['id_quest'] ?? 0; // support dari dua sumber

// Ambil info quest
$quest_result = mysqli_query($koneksi, "SELECT * FROM quests WHERE id_quest = $quest_id LIMIT 1");
$quest = mysqli_fetch_assoc($quest_result);

if (!$quest) {
    echo "<div class='alert alert-danger text-center mt-5'>Quest tidak ditemukan.</div>";
    exit;
}

// Ambil semua chapter dari quest ini
$chapters = mysqli_query($koneksi, "SELECT * FROM quest_chapters WHERE id_quest = $quest_id ORDER BY nomor_chapter ASC");

// Ambil progress user
$progress_data = [];
$progress_query = mysqli_query($koneksi, "SELECT * FROM user_chapter_progress WHERE id_user = $user_id AND id_progress = $quest_id");
while ($row = mysqli_fetch_assoc($progress_query)) {
    $progress_data[$row['id_chapter']] = $row;
}

// Hitung apakah semua chapter sudah selesai
$total_chapters = mysqli_num_rows($chapters);
mysqli_data_seek($chapters, 0); // reset pointer

$completed_chapters = 0;
while ($ch = mysqli_fetch_assoc($chapters)) {
    $cid = $ch['id_chapter'];
    if (isset($progress_data[$cid]) && $progress_data[$cid]['sudah_selesai'] == 1) {
        $completed_chapters++;
    }
}
$all_done = $completed_chapters >= $total_chapters;
mysqli_data_seek($chapters, 0); // reset lagi sebelum ditampilkan
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pilih Chapter - <?= htmlspecialchars($quest['judul']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css" />
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "PixelifySans", sans-serif;
            background-color: #0b122b;
            color: white;
            background-image: url("../assets/images/guild_background_1440x1024.png");
            background-size: cover;
            background-position: center;
            padding-top: 55px;
        }

        .scroll-box {
            background: rgba(255, 248, 220, 0.95);
            border: 3px solid #a37c27;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .list-group-item {
            background-color: #fef7e5;
            border: 1px solid #d4b070;
        }

        .btn-primary {
            background-color: #b07c3a;
            border-color: #a0672a;
        }

        .btn-primary:hover {
            background-color: #a0672a;
        }

        .btn-outline-secondary {
            border-color: #7b5c3a;
            color: #7b5c3a;
        }

        .btn-outline-secondary:hover {
            background-color: #7b5c3a;
            color: #fff;
        }

        .btn-secondary {
            background-color: #aaa;
            border-color: #888;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        h2,
        h5 {
            color: #5a3b1a;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container mt-5">
        <div class="scroll-box">
            <h2 class="mb-4">Quest: <?= htmlspecialchars($quest['judul']) ?></h2>

            <div class="list-group">
                <?php
                $chapter_index = 0;
                $next_chapter_found = false;

                while ($chapter = mysqli_fetch_assoc($chapters)):
                    $chapter_index++;
                    $chapter_id = $chapter['id_chapter'];
                    $user_progress = $progress_data[$chapter_id] ?? null;
                    $is_done = $user_progress && $user_progress['sudah_selesai'] == 1;
                ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h5 class="mb-1">Chapter <?= $chapter_index ?>: <?= htmlspecialchars($chapter['judul_chapter']) ?></h5>
                            <small>Status: <?= $is_done ? '✅ Sudah dikerjakan' : '🕓 Belum dikerjakan' ?></small><br>
                            <?php if ($is_done): ?>
                                <small>Nilai: <?= $user_progress['nilai'] ?> / 100</small><br>
                            <?php endif; ?>
                            <small>Reward: ⭐ <?= $chapter['xp_reward'] ?> XP, 💰 <?= $chapter['coin_reward'] ?> Koin</small>
                        </div>
                        <div>
                            <?php if (!$is_done && !$next_chapter_found && !$all_done): ?>
                                <a href="quest_play.php?id_chapter=<?= $chapter_id ?>" class="btn btn-primary">▶️ Lanjutkan</a>
                                <?php $next_chapter_found = true; ?>
                            <?php elseif ($is_done): ?>
                                <a href="quest_result.php?id_chapter=<?= $chapter_id ?>" class="btn btn-outline-secondary">📜 Lihat Hasil</a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>🔒 Belum Dibuka</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php if ($all_done): ?>
                <div class="alert alert-success mt-4 text-center">
                    🎉 <strong>Selamat!</strong> Kamu telah menyelesaikan semua chapter dalam quest ini!
                </div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="quest_box.php" class="btn btn-outline-secondary">← Kembali ke Kotak Quest</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>