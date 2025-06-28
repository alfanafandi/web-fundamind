<?php
include '../db.php';

// Ambil ID dari URL
$id_user = $_GET['id'] ?? null;

if (!$id_user) {
    die("ID pengguna tidak ditemukan.");
}

// Ambil data pengguna
$query = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("Pengguna tidak ditemukan.");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $level = $_POST['level'];
    $xp = $_POST['xp'];
    $password = $_POST['password'];

    // Hash password jika diisi
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update = "UPDATE users SET username='$username', level='$level', xp='$xp', password='$hashed_password' WHERE id_user = $id_user";
    } else {
        $update = "UPDATE users SET username='$username', level='$level', xp='$xp' WHERE id_user = $id_user";
    }

    if (mysqli_query($koneksi, $update)) {
        header("Location: users_list.php");
        exit;
    } else {
        $error = "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

<?php include 'includes/navbar.php'; ?>
<div class="flex">
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 p-8">
        <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Pengguna</h2>

            <?php if (!empty($error)): ?>
                <div class="text-red-600 mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                    <input type="text" id="username" name="username"
                           placeholder="<?php echo htmlspecialchars($user['username']); ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           value="">
                </div>

                <!-- Level -->
                <div class="mb-4">
                    <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
                    <input type="number" id="level" name="level"
                           placeholder="<?php echo $user['level']; ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           min="1" value="">
                </div>

                <!-- XP -->
                <div class="mb-4">
                    <label for="xp" class="block text-gray-700 text-sm font-bold mb-2">XP</label>
                    <input type="number" id="xp" name="xp"
                           placeholder="<?php echo $user['xp']; ?>"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                           min="0" value="">
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password (Kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                </div>

                <div class="flex justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="users_list.php"
                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
