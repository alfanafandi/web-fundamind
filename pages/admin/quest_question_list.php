<?php
session_start();
include __DIR__ . '../../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM quest_questions");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT id_question, id_chapter, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, petunjuk, min_level FROM quest_questions ORDER BY id_question ASC LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Quest Question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Quest Question</h2>
                <a href="index.php?modul=quest_question&fitur=create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    + Tambah Soal
                </a>
            </div>

            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-800 text-white uppercase">
                        <tr>
                            <th class="px-2 py-3 w-10 text-center">ID</th>
                            <th class="px-2 py-3 w-14 text-center">Chapter</th>
                            <th class="px-2 py-3 w-44 text-left">Pertanyaan</th>
                            <th class="px-2 py-3 w-24 text-left">A</th>
                            <th class="px-2 py-3 w-24 text-left">B</th>
                            <th class="px-2 py-3 w-24 text-left">C</th>
                            <th class="px-2 py-3 w-24 text-left">D</th>
                            <th class="px-2 py-3 w-10 text-center">Benar</th>
                            <th class="px-2 py-3 w-32 text-left">Petunjuk</th>
                            <th class="px-2 py-3 w-10 text-center">Level</th>
                            <th class="px-2 py-3 w-20 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php while ($q = mysqli_fetch_assoc($result)) : ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-2 py-3 text-center"><?php echo $q['id_question']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $q['id_chapter']; ?></td>
                                <td class="px-2 py-3 max-w-[180px] truncate"><?php echo htmlspecialchars($q['pertanyaan']); ?></td>
                                <td class="px-2 py-3 max-w-[100px] truncate"><?php echo htmlspecialchars($q['pilihan_a']); ?></td>
                                <td class="px-2 py-3 max-w-[100px] truncate"><?php echo htmlspecialchars($q['pilihan_b']); ?></td>
                                <td class="px-2 py-3 max-w-[100px] truncate"><?php echo htmlspecialchars($q['pilihan_c']); ?></td>
                                <td class="px-2 py-3 max-w-[100px] truncate"><?php echo htmlspecialchars($q['pilihan_d']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($q['jawaban_benar']); ?></td>
                                <td class="px-2 py-3 max-w-[100px] truncate"><?php echo htmlspecialchars($q['petunjuk']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $q['min_level']; ?></td>
                                <td class="px-2 py-3 text-center space-x-2">
                                    <a href="index.php?modul=quest_question&fitur=edit&id=<?php echo $q['id_question']; ?>" class="text-blue-600 hover:underline">Edit</a>
                                    <a href="index.php?modul=quest_question&fitur=delete&id=<?php echo $q['id_question']; ?>" onclick="return confirm('Yakin ingin menghapus soal ini?')" class="text-red-600 hover:underline">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?modul=quest_question&fitur=list&page=<?php echo $i; ?>"
                       class="px-3 py-1 rounded <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>
</html>
