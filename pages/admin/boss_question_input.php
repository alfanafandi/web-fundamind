<?php
include 'pages/db.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Soal Boss</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Tambah Soal Boss</h2>

            <form action="index.php?modul=boss_question&fitur=create" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <div class="mb-4">
                    <label for="id_boss" class="block text-gray-700 font-semibold mb-1">ID Boss</label>
                    <input type="number" name="id_boss" id="id_boss" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="pertanyaan" class="block text-gray-700 font-semibold mb-1">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>
                <?php foreach (['a', 'b', 'c', 'd'] as $opt): ?>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Pilihan <?= strtoupper($opt) ?></label>
                        <input type="text" name="pilihan_<?= $opt ?>" class="w-full p-2 border border-gray-300 rounded" required>
                    </div>
                <?php endforeach; ?>
                <div class="mb-4">
                    <label for="jawaban_benar" class="block text-gray-700 font-semibold mb-1">Jawaban Benar (a/b/c/d)</label>
                    <input type="text" name="jawaban_benar" id="jawaban_benar" maxlength="1" class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="petunjuk" class="block text-gray-700 font-semibold mb-1">Petunjuk</label>
                    <input type="text" name="petunjuk" id="petunjuk" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Soal
                    </button>
                    <a href="index.php?modul=boss_question&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
