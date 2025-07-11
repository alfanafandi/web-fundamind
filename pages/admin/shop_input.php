<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Item Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <?php include 'includes/navbar.php'; ?>
  <div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Item Shop</h2>

      <form action="index.php?modul=shop&fitur=create" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
        <!-- Nama Item -->
        <div class="mb-4">
          <label for="nama_item" class="block text-gray-700 font-semibold mb-1">Nama Item</label>
          <input type="text" name="nama_item" id="nama_item" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Tipe Item -->
        <div class="mb-4">
          <label for="tipe_item" class="block text-gray-700 font-semibold mb-1">Tipe Item</label>
          <input type="text" name="tipe_item" id="tipe_item" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Deskripsi -->
        <div class="mb-4">
          <label for="deskripsi" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
          <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full p-2 border border-gray-300 rounded" required></textarea>
        </div>

        <!-- Harga Coin -->
        <div class="mb-4">
          <label for="harga_coin" class="block text-gray-700 font-semibold mb-1">Harga (Coin)</label>
          <input type="number" name="harga_coin" id="harga_coin" class="w-full p-2 border border-gray-300 rounded" min="0" required>
        </div>

        <!-- File Icon -->
        <div class="mb-4">
          <label for="file_icon" class="block text-gray-700 font-semibold mb-1">Upload Icon (PNG/JPG/JPEG)</label>
          <input type="file" name="file_icon" id="file_icon" accept="image/png, image/jpeg, image/jpg" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6">
          <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Simpan Item
          </button>
          <a href="index.php?modul=shop&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
