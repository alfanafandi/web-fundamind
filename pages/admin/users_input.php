<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <?php include 'includes/navbar.php'; ?>
  <div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Pengguna Baru</h2>

      <form action="index.php?modul=user&fitur=create" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
        <!-- Username -->
        <div class="mb-4">
          <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
          <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
          <label for="password" class="block text-gray-700 font-semibold mb-1">Password</label>
          <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Level -->
        <div class="mb-4">
          <label for="level" class="block text-gray-700 font-semibold mb-1">Level</label>
          <input type="number" name="level" id="level" class="w-full p-2 border border-gray-300 rounded" required min="1">
        </div>

        <!-- XP -->
        <div class="mb-4">
          <label for="xp" class="block text-gray-700 font-semibold mb-1">XP</label>
          <input type="number" name="xp" id="xp" class="w-full p-2 border border-gray-300 rounded" value="0" required min="0">
        </div>

        <!-- Submit -->
        <div class="mt-6">
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Simpan Pengguna
          </button>
          <a href="index.php?modul=user&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
