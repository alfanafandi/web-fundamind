<?php
include 'pages/db.php';

$id_question = $_GET['id'] ?? null;
if (!$id_question) die("ID question tidak ditemukan.");

$query = "SELECT * FROM quest_questions WHERE id_question = $id_question";
$result = mysqli_query($koneksi, $query);
$question = mysqli_fetch_assoc($result);
if (!$question) die("Data question tidak ditemukan.");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Quest Question</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <?php include 'includes/navbar.php'; ?>
    <div class="flex">
        <?php include 'includes/sidebar.php'; ?>

        <div class="flex-1 p-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Edit Quest Question</h2>

            <form action="index.php?modul=quest_question&fitur=edit&id=<?php echo $question['id_question']; ?>" method="POST" class="bg-white p-6 rounded shadow-md w-full max-w-xl">
                <div class="mb-4">
                    <label for="id_chapter" class="block text-gray-700 font-semibold mb-1">ID Chapter</label>
                    <input type="number" name="id_chapter" id="id_chapter" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $question['id_chapter']; ?>">
                </div>
                <div class="mb-4">
                    <label for="pertanyaan" class="block text-gray-700 font-semibold mb-1">Pertanyaan</label>
                    <textarea name="pertanyaan" id="pertanyaan" rows="3" class="w-full p-2 border border-gray-300 rounded" required><?php echo htmlspecialchars($question['pertanyaan']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Pilihan A</label>
                    <input type="text" name="pilihan_a" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['pilihan_a']); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Pilihan B</label>
                    <input type="text" name="pilihan_b" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['pilihan_b']); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Pilihan C</label>
                    <input type="text" name="pilihan_c" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['pilihan_c']); ?>">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-1">Pilihan D</label>
                    <input type="text" name="pilihan_d" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['pilihan_d']); ?>">
                </div>
                <div class="mb-4">
                    <label for="jawaban_benar" class="block text-gray-700 font-semibold mb-1">Jawaban Benar (a/b/c/d)</label>
                    <input type="text" name="jawaban_benar" id="jawaban_benar" maxlength="1" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['jawaban_benar']); ?>">
                </div>
                <div class="mb-4">
                    <label for="petunjuk" class="block text-gray-700 font-semibold mb-1">Petunjuk</label>
                    <input type="text" name="petunjuk" id="petunjuk" class="w-full p-2 border border-gray-300 rounded" value="<?php echo htmlspecialchars($question['petunjuk']); ?>">
                </div>
                <div class="mb-4">
                    <label for="min_level" class="block text-gray-700 font-semibold mb-1">Minimal Level</label>
                    <input type="number" name="min_level" id="min_level" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo $question['min_level']; ?>">
                </div>
                <div class="mb-4">
                    <label for="kategori" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="w-full p-2 border border-gray-300 rounded" required value="<?php echo htmlspecialchars($question['kategori']); ?>">
                </div>
                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php?modul=quest_question&fitur=list" class="ml-4 text-blue-600 hover:underline">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
