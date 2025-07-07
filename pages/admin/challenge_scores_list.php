<?php
session_start();
include __DIR__ . '../../db.php';

$perPage = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

$totalResult = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM challenge_scores");
$totalRows = mysqli_fetch_assoc($totalResult)['total'];
$totalPages = ceil($totalRows / $perPage);

$query = "SELECT cs.id, cs.id_user, u.username, cs.score, cs.waktu 
          FROM challenge_scores cs 
          LEFT JOIN users u ON cs.id_user = u.id_user 
          ORDER BY cs.id DESC
          LIMIT $perPage OFFSET $offset";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Challenge Scores</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>

    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">

            <div class="bg-white shadow-md rounded overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-800 text-white uppercase">
                        <tr>
                            <th class="px-2 py-3 w-10 text-center">ID</th>
                            <th class="px-2 py-3 w-20 text-center">User ID</th>
                            <th class="px-2 py-3 w-32 text-left">Username</th>
                            <th class="px-2 py-3 w-20 text-center">Score</th>
                            <th class="px-2 py-3 w-32 text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-2 py-3 text-center"><?php echo $row['id']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $row['id_user']; ?></td>
                                <td class="px-2 py-3"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="px-2 py-3 text-center"><?php echo $row['score']; ?></td>
                                <td class="px-2 py-3 text-center"><?php echo htmlspecialchars($row['waktu']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="mt-4 flex justify-center space-x-2">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?modul=challenge_scores&fitur=list&page=<?php echo $i; ?>"
                       class="px-3 py-1 rounded <?php echo $i == $page ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>
</html>
            </div>
        </div>
    </div>
</body>
</html>
