<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$_SESSION['visited_shop'] = true;
$id_user = $_SESSION['user_id'];

if (
  isset($_SESSION['visited_guild']) &&
  isset($_SESSION['visited_shop']) &&
  isset($_SESSION['visited_profile'])
) {
  mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($id_user, 6)");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/shop.css" />
  <link rel="stylesheet" href="../assets/css/navbar.css" />
</head>
<body>
  <?php include 'includes/navbar.php'; ?>
  <section class="shop-owner-main">
    <div class="shop-owner" id="shopOwner">
      <img src="../assets/images/body_character_of_a_female_shopkeeper_in_an_idle_pose.png" alt="Shop Owner" />
      <img src="../assets/images/StarShine.gif" class="starshine" alt="Starshine" />
    </div>
    <div class="welcome-seller" id="welcomeSeller"></div>
  </section>

  <a href="shop_board.php" class="shop-board-link"></a>
  <div class="starshine-board">
    <img src="../assets/images/StarShine.gif" alt="StarShine Board" />
  </div>

  <script>
    const messages = [
      "Selamat Datang di Toko Fundamind, Klik untuk melihat Daftar Item!"
    ];
    let currentMessage = 0;
    const shopOwner = document.getElementById("shopOwner");
    const welcome = document.getElementById("welcomeSeller");

    shopOwner.addEventListener("click", () => {
      welcome.innerText = messages[currentMessage];
      welcome.style.display = "block";
    });

    welcome.addEventListener("click", () => {
      currentMessage++;
      if (currentMessage < messages.length) {
        welcome.innerText = messages[currentMessage];
      } else {
        // Redirect ke halaman beli item
        window.location.href = "shop_board.php";
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
