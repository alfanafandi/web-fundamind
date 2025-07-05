<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

unset($_SESSION['challenge_result']);

$quests = [
    'story' => [],
    'challenge' => [],
    'boss_battle' => []
];

$result = mysqli_query($koneksi, "SELECT * FROM quests ORDER BY id_quest ASC");
while ($row = mysqli_fetch_assoc($result)) {
    $quests[$row['kategori']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kotak Quest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css" />
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            font-family: "PixelifySans", sans-serif;
            background: url('../assets/images/guild_background_1440x1024.png') no-repeat center center fixed;
            background-size: cover;
            padding-top: 60px;
            color: #fff;
        }

        .board-container {
            background-image: url('../assets/images/wood_texture_pixel.png');
            background-size: cover;
            border: 6px solid #d7a84b;
            border-radius: 18px;
            padding: 2rem;
        }

        .quest-card {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 12px;
            padding: 1rem;
            transition: transform 0.3s ease;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
        }

        .quest-card:hover {
            transform: scale(1.05);
        }

        .quest-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #3d2e18;
        }

        .quest-desc {
            font-size: 0.9rem;
            color: #4e3d28;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #495057;
        }

        .card-img-top {
            width: 60px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="board-container w-100" style="max-width: 960px;">
            <h1 class="text-center fw-bold mb-4" style="color: #eee;">Kotak Quest</h1>

            <div class="row g-4">
                <?php
                $icons = [
                    'story' => '../assets/images/Ruin_of_Math 1.png',
                    'challenge' => '../assets/images/The_Five_Crystals_of_Unity 1.png',
                    'boss_battle' => '../assets/images/The_Shattered_Aksara 1.png'
                ];

                foreach ($quests as $kategori => $dataList):
                    foreach ($dataList as $quest):
                        // Tentukan URL tujuan
                        if ($kategori === 'challenge') {
                            $url = "challenge_ready.php?id={$quest['id_quest']}";
                        } elseif ($kategori === 'boss_battle') {
                            $url = "quest_boss.php?id={$quest['id_quest']}";
                        } else {
                            $url = "quest_chapter.php?id={$quest['id_quest']}";
                        }

                ?>
                        <div class="col-md-4">
                            <a href="<?= $url ?>" class="text-decoration-none">
                                <div class="card quest-card text-center h-100">
                                    <img src="<?= $icons[$kategori]; ?>" class="card-img-top mx-auto" alt="Icon <?= $kategori; ?>">
                                    <div class="card-body">
                                        <h5 class="quest-title"><?= htmlspecialchars($quest['judul']); ?></h5>
                                        <p class="quest-desc"><?= htmlspecialchars($quest['deskripsi'] ?? ''); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                <?php
                    endforeach;
                endforeach;
                ?>
            </div>

            <div class="text-center mt-4">
                <a href="guild.php" class="btn-back">← Kembali ke Guild</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>