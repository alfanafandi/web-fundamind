<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $sql);
$user = mysqli_fetch_assoc($result);

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bio = isset($_POST['bio']) ? mysqli_real_escape_string($koneksi, $_POST['bio']) : '';
    $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : 'Ellipse_1.png';

    $update = "UPDATE users SET bio = '$bio', avatar = '$avatar' WHERE id_user = $id_user";
    if (mysqli_query($koneksi, $update)) {
        $_SESSION['success'] = "Profil berhasil diperbarui!";
        $_SESSION['avatar'] = $avatar;
        $_SESSION['bio'] = $bio;

        if (!empty($bio) && $avatar !== 'Ellipse_1.png') {
            mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($id_user, 2)");
        }
        if (strlen($bio) > 50) {
            mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($id_user, 4)");
        }
        header("Location: profile.php");
        exit;
    } else {
        $error = "Gagal memperbarui profil.";
    }
}

$avatar_options = ['Ellipse_1.png', 'Ellipse_2.png', 'Ellipse_3.png', 'Ellipse_4.png', 'Ellipse_5.png'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/edit_profile.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <div class="container" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Edit Profile</h2>
        <div class="card p-4">
            <form method="POST">
                <div class="mb-3 text-center">
                    <label class="form-label d-block text-white">Pilih Avatar</label>
                    <div class="avatar-options">
                        <?php foreach ($avatar_options as $option): ?>
                            <input
                                type="radio"
                                id="avatar_<?php echo $option; ?>"
                                name="avatar"
                                value="<?php echo $option; ?>"
                                class="avatar-radio"
                                <?php if ($user['avatar'] === $option) echo 'checked'; ?>>
                            <label for="avatar_<?php echo $option; ?>" class="avatar-label">
                                <img src="../assets/images/<?php echo $option; ?>" alt="<?php echo $option; ?>">
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="bio" class="form-control" rows="3" placeholder="Tulis bio-mu di sini" style="color: white !important;" onfocus="this.style.color='white'" onblur="this.style.color='white'"><?php echo isset($user['bio']) ? trim(htmlspecialchars($user['bio'])) : ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-info w-100">Simpan Perubahan</button>
                <a href="profile.php" class="btn btn-secondary w-100 mt-2">Batal</a>
            </form>
        </div>
    </div>
</body>

</html>