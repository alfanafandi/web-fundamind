<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID quest tidak ditemukan.";
    exit;
}

$id_quest = (int) $_GET['id'];

// Ambil data quest kategori 'story'
$quest_result = mysqli_query($koneksi, "SELECT * FROM quests WHERE id_quest = $id_quest AND kategori = 'story'");
$quest = mysqli_fetch_assoc($quest_result);

if (!$quest) {
    echo "Quest tidak ditemukan atau bukan quest story.";
    exit;
}

// Ambil daftar chapter dari quest ini
$chapters = [];
$chapter_result = mysqli_query($koneksi, "SELECT * FROM quest_chapters WHERE id_quest = $id_quest ORDER BY nomor_chapter ASC");
while ($row = mysqli_fetch_assoc($chapter_result)) {
    $chapters[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($quest['judul']); ?> - Chapter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', sans-serif;
            padding: 60px 0;
            color: #333;
        }

        .chapter-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 24px;
        }

        .bubble {
            background-color: #fff;
            border-radius: 50%;
            width: 140px;
            height: 140px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: 0.2s;
            text-align: center;
            color: #333;
            text-decoration: none;
            position: relative;
        }

        .bubble:hover {
            transform: scale(1.05);
        }

        .bubble h5 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .reward {
            font-size: 0.85rem;
        }

        .btn-back {
            background-color: #ff9800;
            color: white;
            font-weight: bold;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #e68900;
        }

        .emoji {
            font-size: 1.4rem;
        }
    </style>
</head>
<body>

<div class="container text-center">
    <h2 class="mb-3"><?= htmlspecialchars($quest['judul']); ?></h2>
    <p class="mb-5"><?= htmlspecialchars($quest['deskripsi']); ?></p>

    <?php if (count($chapters) > 0): ?>
        <div class="chapter-grid">
            <?php foreach ($chapters as $chap): ?>
                <a href="quest_play.php?chapter_id=<?= $chap['id_chapter']; ?>" class="bubble">
                    <h5>Chapter <?= $chap['nomor_chapter']; ?></h5>
                    <div class="reward emoji">⭐ <?= $chap['xp_reward']; ?> XP</div>
                    <div class="reward emoji">🪙 <?= $chap['coin_reward']; ?> Coin</div>
                </a>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Belum ada chapter tersedia untuk quest ini.</p>
    <?php endif; ?>

    <div class="mt-5">
        <a href="quest_box.php" class="btn-back">← Kembali ke Kotak Quest</a>
    </div>
</div>

</body>
</html>
