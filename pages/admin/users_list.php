<?php
include __DIR__ . '/../db.php';

$query = "SELECT id_user, username, level, xp FROM users ORDER BY id_user ASC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Pengguna</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <?php include 'includes/navbar.php'; ?>

  <div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
      <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
          <a href="index.php?modul=user&fitur=create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Tambah Pengguna
          </a>
        </div>

        <div class="bg-white shadow-md rounded overflow-x-auto">
          <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white text-sm uppercase">
              <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Username</th>
                <th class="px-4 py-3 text-center">Level</th>
                <th class="px-4 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
              <?php
              // Asumsikan $result sudah ada dari bagian atas halaman
              while ($user = mysqli_fetch_assoc($result)):
              ?>
                <tr class="border-b hover:bg-gray-50">
                  <td class="px-4 py-3"><?php echo $user['id_user']; ?></td>
                  <td class="px-4 py-3"><?php echo htmlspecialchars($user['username']); ?></td>
                  <td class="px-4 py-3 text-center"><?php echo $user['level']; ?></td>
                  <td class="px-4 py-3 text-center space-x-2">
                    <a href="users_update.php?id=<?php echo $user['id_user']; ?>" class="text-blue-600 hover:underline">Edit</a>
                    <a href="index.php?modul=user&fitur=delete&id=<?php echo $user['id_user']; ?>"
                      onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                      class="text-red-600 hover:underline">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>

</html>