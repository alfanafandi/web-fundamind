<?php
include 'db.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
  if (mysqli_num_rows($check) > 0) {
    $error = "Username sudah digunakan.";
  } else {
    $insert = mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
    if ($insert) {
      $success = "Registrasi berhasil! Silakan login.";
    } else {
      $error = "Gagal registrasi.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register - Fundamind</title>
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
      box-shadow: 0 4px 24px rgba(0,0,0,0.15);
      padding: 32px 28px;
      background: #101a3a;
      color: white;
    }
  </style>
</head>
<body class="min-vh-100 d-flex align-items-center justify-content-center">
  <?php include 'includes/navbar.php'; ?>
  <div class="login-card text-center">
    <h2>Register</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>
    <form method="POST">
      <div class="mb-3">
        <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" required />
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required />
      </div>
      <button type="submit" class="btn btn-info w-100 btn-lg">Register</button>
      <p class="mt-3"><a href="login.php" class="text-info">Sudah punya akun?</a></p>
    </form>
  </div>
</body>
</html>
