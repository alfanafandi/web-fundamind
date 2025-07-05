<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: quest_box.php");
    exit;
}

$id_quest = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Ambil quest terkait
$quest = mysqli_query($koneksi, "SELECT * FROM quests WHERE id_quest = $id_quest AND kategori = 'challenge'");
$data_quest = mysqli_fetch_assoc($quest);
if (!$data_quest) {
    echo "Quest tidak ditemukan.";
    exit;
}

// Ambil leaderboard top 10
$query = "SELECT users.username, MAX(challenge_scores.score) AS score 
          FROM challenge_scores 
          JOIN users ON challenge_scores.id_user = users.id_user 
          GROUP BY challenge_scores.id_user 
          ORDER BY score DESC 
          LIMIT 10";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Persiapan Challenge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <style>
        @font-face {
            font-family: "PixelifySans";
            src: url("../assets/fonts/PixelifySans-VariableFont_wght.ttf") format("truetype");
        }

        body {
            background: url('../assets/images/guild_background_1440x1024.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'PixelifySans', sans-serif;
            padding-top: 60px;
            color: #fff;
        }

        .leaderboard-container {
            background-image: url('../assets/images/wood_texture_pixel.png');
            background-size: cover;
            border: 8px solid #f4c542;
            border-radius: 20px;
            padding: 2.5rem;
            max-width: 860px;
            margin: auto;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .leaderboard-container h2,
        .leaderboard-container p {
            color: #fffbe5;
            text-shadow: 1px 1px 2px #000;
        }

        .btn-start {
            background-color: #f4c542;
            color: #3a270d;
            font-weight: bold;
            padding: 12px 32px;
            border-radius: 12px;
            border: 3px solid #b38728;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .btn-start:hover {
            background-color: #e2b834;
        }

        table {
            width: 100%;
            color: #3a270d;
            background-color: #fffceb;
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background-color: #f9dd77;
            color: #3a270d;
        }

        td, th {
            padding: 12px;
            border: 1px solid #d9ba66;
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="leaderboard-container text-center">
        <h2 class="fw-bold mb-4"><?= htmlspecialchars($data_quest['judul']); ?></h2>
        <p class="mb-4"><?= htmlspecialchars($data_quest['deskripsi']); ?></p>

        <h4 class="mb-3">🏆 Top 10 Papan Skor</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Skor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$rank}</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . $row['score'] . "</td>";
                        echo "</tr>";
                        $rank++;
                    }
                    if ($rank === 1) {
                        echo "<tr><td colspan='3'>Belum ada skor tercatat.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a href="challenge_play.php?id=<?= $id_quest ?>" class="btn btn-start mt-4">🚀 Mulai Challenge</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
