<?php
include 'pages/db.php';

$id_question = $_GET['id'] ?? null;
if (!$id_question) die("ID question tidak ditemukan.");

$query = "SELECT * FROM boss_questions WHERE id_question = $id_question";
$result = mysqli_query($koneksi, $query);
$question = mysqli_fetch_assoc($result);
if (!$question) die("Data question tidak ditemukan.");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Soal Boss</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Soal Boss</h2>

            <form action="index.php?modul=boss_question&fitur=edit&id=<?php echo $question['id_question']; ?>" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <div class="mb-4">
                    <label for="id_boss" class="block text-gray-700 font-semibold mb-1">ID Boss</label>
                    <input type="number" name="id_boss" id="id_boss" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $question['id_boss']; ?>">
                </div>
                <div class="mb-4">
                    <label for="pertanyaan" class="block text-gray-700 font-semibold mb-1">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3" class="w-full p-2 border border-gray-300 rounded" required><?php echo htmlspecialchars($question['pertanyaan']); ?></textarea>
                </div>
                <?php foreach (['a', 'b', 'c', 'd'] as $opt): ?>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Pilihan <?= strtoupper($opt) ?></label>
                        <input type="text" name="pilihan_<?= $opt ?>" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question["pilihan_$opt"]); ?>">
                    </div>
                <?php endforeach; ?>
                <div class="mb-4">
                    <label for="jawaban_benar" class="block text-gray-700 font-semibold mb-1">Jawaban Benar (a/b/c/d)</label>
                    <input type="text" name="jawaban_benar" id="jawaban_benar" maxlength="1" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['jawaban_benar']); ?>">
                </div>
                <div class="mb-4">
                    <label for="petunjuk" class="block text-gray-700 font-semibold mb-1">Petunjuk</label>
                    <input type="text" name="petunjuk" id="petunjuk" class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($question['petunjuk']); ?>">
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=boss_question&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
