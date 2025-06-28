<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Achievement</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <?php include 'includes/navbar.php'; ?>
  <div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Achievement Baru</h2>

      <form action="index.php?modul=achievement&fitur=create" method="POST" class="bg-white p-6 rounded shadow-md max-w-xl">
        <!-- Nama Achievement -->
        <div class="mb-4">
          <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama Achievement</label>
          <input type="text" name="nama" id="nama" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <!-- Syarat (Query SQL) -->
        <div class="mb-4">
          <label for="syarat" class="block text-gray-700 font-semibold mb-1">Syarat (Query SQL)</label>
          <textarea name="syarat" id="syarat" rows="5" class="w-full p-2 border border-gray-300 rounded" placeholder="Contoh: SELECT COUNT(*) FROM users WHERE level >= 5" required></textarea>
        </div>

        <!-- Tombol -->
        <div class="mt-6">
          <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Simpan Achievement
          </button>
          <a href="index.php?modul=achievement&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
