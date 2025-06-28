<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION['user_id'];
$_SESSION['visited_shop'] = true;

$sql = "SELECT * FROM users WHERE id_user = $id_user";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/shop.css" />
    <link rel="stylesheet" href="../assets/css/navbar.css" />
  </head>
  <body>
     <?php include 'includes/navbar.php'; ?>
    <section class="shop-owner-main">
      <!-- Shop owner -->
      <div class="shop-owner" id="shopOwner">
        <img
          src="../assets/images/body_character_of_a_female_shopkeeper_in_an_idle_pose.png"
          alt="Shop Owner"
        />
      </div>

      <!-- Teks dialog (awalnya disembunyikan) -->
      <div class="welcome-seller" id="welcomeSeller">
        <!-- Teks akan muncul saat shopOwner diklik -->
      </div>
    </section>

    <script>
      const messages = [
        "Welcome Seller!",
        "Di sini aku menjual berbagai item"
      ];
      let currentMessage = 0;
      const shopOwner = document.getElementById("shopOwner");
      const welcome = document.getElementById("welcomeSeller");

      // Saat shop owner diklik pertama kali
      shopOwner.addEventListener("click", function () {
        welcome.innerText = messages[currentMessage];
        welcome.style.display = "block";
      });

      // Saat teks diklik untuk lanjutkan pesan
      welcome.addEventListener("click", function () {
        currentMessage++;
        if (currentMessage < messages.length) {
          welcome.innerText = messages[currentMessage];
        } else {
          // Sembunyikan setelah pesan terakhir
          welcome.style.display = "none";
          currentMessage = 0; // reset jika mau ulang
        }
      });
    </script>
  </body>
</html>
