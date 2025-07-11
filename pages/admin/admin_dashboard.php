<?php
session_start();
include 'pages/db.php';

$total_users = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users"))['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <!-- Navbar -->
  <?php include 'includes/navbar.php'; ?>

  <div class="flex">
    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <h1 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, Admin!</h1>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kartu Jumlah Pengguna -->
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Pengguna</h2>
          <p class="text-3xl font-bold text-blue-600"><?php echo $total_users; ?></p>
        </div>


      <!-- Tambahan Konten -->
      <div class="mt-10">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Manajemen</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <a href="users_list.php" class="block bg-blue-500 hover:bg-blue-600 text-white text-center py-4 rounded shadow">Kelola Pengguna</a>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
