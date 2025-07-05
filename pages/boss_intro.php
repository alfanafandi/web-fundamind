<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_boss = $_GET['id_boss'] ?? 0;
$query = mysqli_query($koneksi, "
    SELECT b.*, q.judul AS judul_quest 
    FROM boss_unlock_requirements b 
    JOIN quests q ON b.id_quest = q.id_quest 
    WHERE b.id_boss = $id_boss
");
$boss = mysqli_fetch_assoc($query);

if (!$boss) {
    echo "<div class='text-center mt-5 text-danger'>Boss tidak ditemukan.</div>";
    exit;
}

$bg_file_name = $boss['background_image'];
$boss_file_name = $boss['boss_image'];

$bg_image = '../assets/images/' . $bg_file_name;
$boss_image = '../assets/images/' . $boss_file_name;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Intro Boss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            font-family: "PixelifySans", sans-serif;
            background-image: url('<?= htmlspecialchars($bg_image) ?>');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 65px;
        }

        .intro-box {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 3px solid rgba(255, 255, 255, 0.25);
            border-radius: 20px;
            padding: 40px;
            max-width: 800px;
            width: 90%;
            text-align: center;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .boss-img {
            width: 200px;
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(3px 3px 5px rgba(0, 0, 0, 0.5));
        }

        .btn-start {
            background-color: #b13d3d;
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .btn-start:hover {
            background-color: #912f2f;
            transform: scale(1.05);
        }

        .title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .description {
            font-size: 1.1rem;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.6);
        }

    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="intro-box">
        <img src="<?= htmlspecialchars($boss_image) ?>" alt="Boss" class="boss-img">
        <div class="title">👑 <?= htmlspecialchars($boss['nama_boss']) ?></div>
        <div class="description">
            <?= htmlspecialchars($boss['deskripsi_boss'] ?? 'Musuh kuat telah muncul di akhir chapter ini!') ?>
        </div>
        <a href="boss_play.php?id_boss=<?= $boss['id_boss'] ?>" class="btn btn-start">⚔️ Mulai Pertarungan</a>
    </div>
</body>
</html>
