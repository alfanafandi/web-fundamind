<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];

// Ambil koin user
$userData = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT coin FROM users WHERE id_user = $id_user"));
$coin = (int) $userData['coin'];
$message = "";

// Proses pembelian
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $item = mysqli_real_escape_string($koneksi, $_POST['item']);
    $price = (int) $_POST['price'];

    if ($coin >= $price) {
        mysqli_query($koneksi, "UPDATE users SET coin = coin - $price WHERE id_user = $id_user");
        mysqli_query($koneksi, "INSERT INTO user_items (id_user, nama_item, jumlah)
          VALUES ($id_user, '$item', 1)
          ON DUPLICATE KEY UPDATE jumlah = jumlah + 1");
        $coin -= $price;
        $message = "Berhasil membeli $item!";
    } else {
        $message = "Koin tidak cukup untuk membeli $item.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Toko Fundamind</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: url('../assets/images/bar_background_1440x1024.png') no-repeat center center fixed;
            background-size: cover;
            background-position: center;
            padding-top: 55px;
        }

        .shop-container {
            max-width: 1000px;
            margin: auto;
            background: burlywood;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 10px #000;
            border: 5px solid #8b5e3c;
        }

        .coin-inside {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 20px;
        }

        .coin-inside img {
            height: 22px;
            vertical-align: middle;
            margin-right: 6px;
        }

        .item-card {
            border: 2px solid #fff;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            transition: transform 0.2s;
            background: rgba(255, 255, 255, 0.85);
        }

        .item-card:hover {
            transform: scale(1.05);
        }

        .item-icon {
            height: 60px;
            margin-bottom: 10px;
        }

        .btn-buy {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 16px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .btn-buy:hover {
            background-color: #0056b3;
        }

        h2.shop-title {
            text-align: center;
            font-weight: bold;
            font-size: 32px;
            color: #fff;
            text-shadow: 2px 2px 3px #000;
            margin-bottom: 20px;
        }

        .btn-back {
            background-color: #6c757d;
            color: white;
            font-weight: bold;
            padding: 10px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .btn-back:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php'; ?>

    <div class="shop-container">
        <h2 class="shop-title">SHOP</h2>

        <div class="coin-inside">
            <img src="../assets/images/realcoin.png" alt="coin"> <?php echo $coin; ?> Coins
        </div>

        <?php if (!empty($message)) : ?>
            <div class="alert alert-info text-center"><?php echo $message; ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <?php
            $items = [
                ['XP Boost', 'xp.png', 15],
                ['Clue', 'clue.png', 15],
                ['Skin', 'skin.png', 10],
                ['Skip Level Pass', 'skip.png', 15],
                ['Magnifying Glass', 'magnify.png', 10],
                ['Time Extension', 'time.png', 10],
            ];

            foreach ($items as $item) :
            ?>
                <div class="col-md-4">
                    <div class="item-card">
                        <img src="../assets/images/<?php echo $item[1]; ?>" alt="<?php echo $item[0]; ?>" class="item-icon" />
                        <h5><?php echo $item[0]; ?></h5>
                        <p><img src="../assets/images/realcoin.png" height="16"> <?php echo $item[2]; ?></p>
                        <form method="POST">
                            <input type="hidden" name="item" value="<?php echo $item[0]; ?>">
                            <input type="hidden" name="price" value="<?php echo $item[2]; ?>">
                            <button class="btn-buy" name="buy">Beli</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tombol kembali di dalam papan -->
        <div class="text-center mt-4">
            <a href="dashboard.php" class="btn-back">← Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
