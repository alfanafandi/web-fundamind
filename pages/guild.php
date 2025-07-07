<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION['user_id'];
$_SESSION['visited_guild'] = true; 


mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($id_user, 5)");

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
    <title>Guild</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/guild.css" />
    <script src="../assets/js/guild.js" defer></script>
    <link rel="stylesheet" href="../assets/css/navbar.css" />
  </head>
  <body class="guild-background">
    <?php include 'includes/navbar.php'; ?>
    <!-- Karakter full body -->
    <section class="guild-master-main">
      <div class="guild-master" id="guildMaster">
        <img
          src="../assets/images/guild_master_in_an_idle_pose.png"
          alt="Guild Master"
        />
         <div class="Star-Shineg">
        <img
          src="../assets/images/StarShine.gif"
          alt="Star Shine"
        />
      </div>
      </div>

      <!-- Tombol quest -->
      <section class="quest">
        <a href="quest_box.php" class="quest-box"></a>
        <div class="Star-Shineq">
          <img src="../assets/images/StarShine.gif" alt="Star Shine Quest" />
        </div>
      </section>

      <div id="questModalContainer"></div>

      <!-- Tombol GM -->
        <div id="guildModal" class="guild-modal hidden">
      <div class="modal-content">
        <img src="../assets/images/half-body_portrait_of_a_guild_master.png" class="halfbody-image" />
        <div class="chat-box">
          <p id="chatText">Selamat Datang Di Guild!</p>
          <button id="nextChat">Next</button>
        </div>
      </div>
    </div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
