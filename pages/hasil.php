<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: proses.php');
    exit();
}

$username   = $_SESSION['username'];
$avatar     = $_SESSION['avatar'];
$difficulty = $_SESSION['difficulty'];
$goal       = $_SESSION['goal'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hasil Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 600px; width: 100%;">
        <h2 class="text-center text-success fw-bold mb-4">Hasil Pendaftaran</h2>

        <div class="mb-3">
            <p class="mb-1"><strong>Nama Pengguna:</strong></p>
            <div class="border p-2 rounded bg-white"><?= htmlspecialchars($username) ?></div>
        </div>

        <div class="mb-3">
            <p class="mb-1"><strong>Avatar yang Dipilih:</strong></p>
            <img src="asset/<?= htmlspecialchars($avatar) ?>.png" alt="<?= htmlspecialchars($avatar) ?>" class="rounded-circle border border-secondary" style="width: 100px; height: 100px;">
        </div>

        <div class="mb-3">
            <p class="mb-1"><strong>Level Kesulitan:</strong></p>
            <span class="badge bg-primary fs-6"><?= htmlspecialchars($difficulty) ?></span>
        </div>

        <div class="mb-4">
            <p class="mb-1"><strong>Tujuan Belajar:</strong></p>
            <div class="border p-2 rounded bg-white">
                <?= !empty($goal) ? htmlspecialchars($goal) : "Tidak diisi" ?>
            </div>
        </div>

        <a href="proses.php" class="btn btn-outline-primary w-100">Kembali ke Form</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
