<?php
include __DIR__ . '/../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM achievements");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT id_achievement, nama, syarat FROM achievements ORDER BY id_achievement ASC LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Achievement</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

  <?php include 'includes/navbar.php'; ?>

  <div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
      <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-2xl font-bold text-gray-800">Daftar Achievement</h2>
          <a href="index.php?modul=achievement&fitur=create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            + Tambah Achievement
          </a>
        </div>

        <div class="bg-white shadow-md rounded overflow-x-auto">
          <table class="min-w-full table-auto">
            <thead class="bg-gray-800 text-white text-sm uppercase">
              <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Syarat</th>
                <th class="px-4 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
              <?php while ($a = mysqli_fetch_assoc($result)): ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="px-4 py-3"><?php echo $a['id_achievement']; ?></td>
                <td class="px-4 py-3"><?php echo htmlspecialchars($a['nama']); ?></td>
                <td class="px-4 py-3"><?php echo htmlspecialchars($a['syarat']); ?></td>
                <td class="px-4 py-3 text-center space-x-2">
                  <a href="index.php?modul=achievement&fitur=edit&id=<?php echo $a['id_achievement']; ?>" class="text-blue-600 hover:underline">Edit</a>
                  <a href="index.php?modul=achievement&fitur=delete&id=<?php echo $a['id_achievement']; ?>" onclick="return confirm('Yakin ingin menghapus achievement ini?')" class="text-red-600 hover:underline">Hapus</a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4 flex justify-center space-x-2">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?modul=achievement&fitur=list&page=<?php echo $i; ?>"
               class="px-3 py-1 rounded <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
              <?php echo $i; ?>
            </a>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
