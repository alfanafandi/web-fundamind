<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];

// Ambil data user (coin dan level)
$userData = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT coin, level FROM users WHERE id_user = $id_user"));
$coin = (int) $userData['coin'];
$level = (int) $userData['level'];
$message = "";

// Proses pembelian item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])) {
    $id_item = (int) $_POST['id_item'];

    // Ambil data item dari database
    $item = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM shop_items WHERE id_item = $id_item"));
    if ($item) {
        $price = (int) $item['harga_coin'];
        $nama_item = $item['nama_item'];
        $level_required = (int) $item['level_minimal'];

        if ($level < $level_required) {
            $message = "Level kamu belum cukup untuk membeli <strong>$nama_item</strong>.";
        } elseif ($coin >= $price) {
            // Kurangi coin user
            mysqli_query($koneksi, "UPDATE users SET coin = coin - $price WHERE id_user = $id_user");

            // Tambah item ke user_items
            $check = mysqli_query($koneksi, "SELECT * FROM user_items WHERE id_user = $id_user AND id_item = $id_item");
            if (mysqli_num_rows($check) > 0) {
                mysqli_query($koneksi, "UPDATE user_items SET jumlah = jumlah + 1 WHERE id_user = $id_user AND id_item = $id_item");
            } else {
                mysqli_query($koneksi, "INSERT INTO user_items (id_user, id_item, jumlah) VALUES ($id_user, $id_item, 1)");
            }

            $coin -= $price;
            $message = "Berhasil membeli <strong>$nama_item</strong>!";
        } else {
            $message = "Koin tidak cukup untuk membeli <strong>$nama_item</strong>.";
        }
    } else {
        $message = "Item tidak ditemukan.";
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

        h2.shop-title {
            text-align: center;
            font-weight: bold;
            font-size: 32px;
            color: #fff;
            text-shadow: 2px 2px 3px #000;
            margin-bottom: 20px;
        }

        .item-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 2px solid #fff;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            transition: transform 0.2s;
        }

        .item-card:hover {
            transform: scale(1.05);
        }

        .item-icon {
            height: 60px;
            margin-bottom: 10px;
        }

        .item-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .item-desc {
            flex-grow: 1;
            font-size: 15px;
            color: #333;
            margin-bottom: 12px;
        }

        .price {
            font-weight: bold;
            margin-bottom: 12px;
        }

        .lock-msg {
            color: #b10000;
            font-size: 14px;
            margin-bottom: 6px;
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

        .btn-disabled {
            background-color: gray;
            pointer-events: none;
            cursor: not-allowed;
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
            $result = mysqli_query($koneksi, "SELECT * FROM shop_items WHERE tersedia = 1 ORDER BY level_minimal ASC");
            while ($item = mysqli_fetch_assoc($result)) :
                $bisa_beli = $level >= (int)$item['level_minimal'];
            ?>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                    <div class="item-card w-100">
                        <div>
                            <img src="../assets/images/<?php echo $item['file_icon']; ?>" alt="<?php echo $item['nama_item']; ?>" class="item-icon" />
                            <div class="item-title"><?php echo $item['nama_item']; ?></div>
                            <div class="item-desc"><?php echo $item['deskripsi']; ?></div>
                            <div class="price"><img src="../assets/images/realcoin.png" height="16"> <?php echo $item['harga_coin']; ?></div>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="id_item" value="<?php echo $item['id_item']; ?>">
                            <?php if ($level >= $item['level_minimal']) : ?>
                                <button class="btn-buy" name="buy">Beli</button>
                            <?php else : ?>
                                <div class="lock-msg">🔒 Butuh Level <?php echo $item['level_minimal']; ?></div>
                                <button class="btn-buy btn-disabled" disabled>Beli</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="text-center mt-4">
            <a href="shop.php" class="btn-back">← Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>