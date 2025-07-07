<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil semua boss dan quest terkait
$bosses = mysqli_query($koneksi, "
    SELECT b.*, q.judul AS judul_quest 
    FROM boss_quests b 
    JOIN quests q ON b.id_quest = q.id_quest 
    ORDER BY b.id_boss ASC
");

// Fungsi untuk cek apakah boss terbuka
function isBossUnlocked($koneksi, $user_id, $id_quest, $start, $end) {
    $chapters = mysqli_query($koneksi, "
        SELECT id_chapter 
        FROM quest_chapters 
        WHERE id_quest = $id_quest AND nomor_chapter BETWEEN $start AND $end
    ");

    $found = false;

    while ($chapter = mysqli_fetch_assoc($chapters)) {
        $found = true;
        $id_ch = $chapter['id_chapter'];

        $check = mysqli_query($koneksi, "
            SELECT 1 
            FROM user_chapter_progress 
            WHERE id_user = $user_id 
              AND id_chapter = $id_ch 
              AND sudah_selesai = 1
        ");
        
        if (mysqli_num_rows($check) === 0) {
            return false; // Ada 1 saja belum selesai → false
        }
    }

    return $found; // hanya true jika ada chapter dan semua sudah selesai
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Boss Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css" />
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            font-family: "PixelifySans", sans-serif;
            background-image: url('../assets/images/guild_background_1440x1024.png');
            background-size: cover;
            background-position: center;
            color: #2e1d0f;
            padding-top: 60px;
        }

        .scroll-box {
            background: rgba(255, 248, 220, 0.95);
            border: 4px solid #a77b3b;
            border-radius: 18px;
            padding: 40px;
            max-width: 900px;
            margin: 40px auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .boss-card {
            background-color: #fff3d4;
            border: 3px solid #d4a246;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .boss-card h4 {
            color: #5e3d13;
        }

        .btn-boss {
            background-color: #b13d3d;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-boss:hover {
            background-color: #912f2f;
        }

        .locked {
            background-color: #ccc;
            color: #555;
            font-weight: bold;
            padding: 10px 25px;
            border: none;
            border-radius: 10px;
            cursor: not-allowed;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #495057;
        }

        h2.title {
            text-align: center;
            color: #4a3513;
            font-weight: bold;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="scroll-box">
        <h2 class="title">🔥 Daftar Boss Quest 🔥</h2>

        <?php while ($boss = mysqli_fetch_assoc($bosses)):
            $unlocked = isBossUnlocked($koneksi, $user_id, $boss['id_quest'], $boss['chapter_start'], $boss['chapter_end']);
        ?>
            <div class="boss-card">
                <h4>👑 <?= htmlspecialchars($boss['nama_boss']) ?></h4>
                <span>🎯 Reward: <?= $boss['xp_reward'] ?> XP, <?= $boss['coin_reward'] ?> Koin</span>
                <p><strong>Persyaratan:</strong> Selesaikan Chapter <?= $boss['chapter_start'] ?> sampai <?= $boss['chapter_end'] ?> dari quest <strong><?= htmlspecialchars($boss['judul_quest']) ?></strong></p>

                <?php if ($unlocked): ?>
                    <a href="boss_intro.php?id_boss=<?= $boss['id_boss'] ?>" class="btn btn-boss">💥 Lawan Boss</a>
                <?php else: ?>
                    <button class="locked" disabled>🔒 Belum terbuka</button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>

        <div class="text-center mt-4">
            <a href="quest_box.php" class="btn-back">← Kembali ke Kotak Quest</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
