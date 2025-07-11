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

// Ambil data user
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT level FROM users WHERE id_user = $user_id"));
$level = $user['level'] ?? 1;

// Tentukan rank berdasarkan level
$rank = 'Bronze';
if ($level >= 20) $rank = 'Diamond';
elseif ($level >= 15) $rank = 'Platinum';
elseif ($level >= 10) $rank = 'Gold';
elseif ($level >= 5) $rank = 'Silver';

// Ambil rank yang dipilih, default ke rank user
$available_ranks = ['Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond'];
$current_rank = $_GET['rank'] ?? $rank;
if (!in_array($current_rank, $available_ranks)) {
    $current_rank = $rank;
}

// Range level berdasarkan rank
$rank_ranges = [
    'Bronze' => [0, 4],
    'Silver' => [5, 9],
    'Gold' => [10, 14],
    'Platinum' => [15, 19],
    'Diamond' => [20, 999]
];
$min_level = $rank_ranges[$current_rank][0];
$max_level = $rank_ranges[$current_rank][1];

// Ambil quest terkait
$quest = mysqli_query($koneksi, "SELECT * FROM quests WHERE id_quest = $id_quest AND kategori = 'challenge'");
$data_quest = mysqli_fetch_assoc($quest);
if (!$data_quest) {
    echo "Quest tidak ditemukan.";
    exit;
}

// Ambil leaderboard
$query = "
    SELECT u.username, MAX(s.score) AS score 
    FROM challenge_scores s
    JOIN users u ON s.id_user = u.id_user
    WHERE u.level BETWEEN $min_level AND $max_level
    GROUP BY s.id_user
    ORDER BY score DESC
    LIMIT 10
";
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

        .btn-rank {
            border: 2px solid #fff3cd;
            background-color: #f7e8c3;
            padding: 8px 16px;
            margin: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: #3a270d;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: 0.2s;
            display: inline-block;
            text-decoration: none;
        }

        .btn-rank.active,
        .btn-rank:hover {
            background-color: #ffe39f;
            border-color: #ffc107;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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

        td,
        th {
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

        <div class="mb-4">
            <?php foreach ($available_ranks as $r): ?>
                <a href="?id=<?= $id_quest ?>&rank=<?= $r ?>" class="btn-rank <?= $r === $current_rank ? 'active' : '' ?>"><?= $r ?></a>
            <?php endforeach; ?>
        </div>

        <h4 class="mb-3">🏆 Top 10 Papan Skor Rank <u><?= $current_rank ?></u></h4>
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
                    $rank_no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$rank_no}</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . $row['score'] . "</td>";
                        echo "</tr>";
                        $rank_no++;
                    }
                    if ($rank_no === 1) {
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
