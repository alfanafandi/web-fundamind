<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  $username = mysqli_real_escape_string($koneksi, $username);

  if ($username === 'admin') {
    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");
    if ($result && mysqli_num_rows($result) === 1) {
      $admin = mysqli_fetch_assoc($result);
      if (password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: /Fundamind-main/index.php?modul=admin&fitur=dashboard");
        exit;
      } else {
        $error = "Password admin salah.";
      }
    } else {
      $error = "Admin tidak ditemukan.";
    }
  } else {
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
    if ($result && mysqli_num_rows($result) === 1) {
      $user = mysqli_fetch_assoc($result);
      if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['avatar'] = $user['avatar'];

        $user_id = $user['id_user'];
        mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($user_id, 1)");

        header("Location: dashboard.php");
        exit;
      } else {
        $error = "Password salah.";
      }
    } else {
      $error = "Akun tidak ditemukan.";
    }
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Login - Fundamind</title>
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
      background-color: #0b122b;
      color: white;
      background-image: url("../assets/images/BackgroundBlueSkyPixel.webp");
      background-size: cover;
      background-position: center;
    }

    .login-card {
      max-width: 370px;
      margin: auto;
      border-radius: 20px;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
      padding: 32px 28px;
      background: #101a3a;
      color: white;
    }
  </style>
</head>

<body class="min-vh-100 d-flex align-items-center justify-content-center">
  <?php include 'includes/navbar.php'; ?>

  <div class="login-card text-center">
    <h2>Login</h2>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required />
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
      </div>
      <button type="submit" class="btn btn-info w-100 btn-lg">Login</button>
      <p class="mt-3"><a href="register.php" class="text-info">Belum punya akun?</a></p>
    </form>
  </div>
</body>

</html>