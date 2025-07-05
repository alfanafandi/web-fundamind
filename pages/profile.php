<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$id_user = $_SESSION['user_id'];
$_SESSION['visited_profile'] = true;

$sql = "SELECT * FROM users WHERE id_user = $id_user";
if (
  isset($_SESSION['visited_guild']) &&
  isset($_SESSION['visited_shop']) &&
  isset($_SESSION['visited_profile'])
) {
  mysqli_query($koneksi, "INSERT IGNORE INTO user_achievements (id_user, id_achievement) VALUES ($id_user, 6)");
}

$result = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fundamind Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/profile.css">
  <link rel="stylesheet" href="../assets/css/navbar.css" />
</head>

<body>
  <?php include 'includes/navbar.php'; ?>
  <div class="container">
    <div class="profile-card mb-4 text-center">
      <img src="../assets/images/<?php echo htmlspecialchars($data['avatar']); ?>" alt="avatar" class="avatar mb-3">
      <h3><?php echo htmlspecialchars($data['username']); ?></h3>
      <p>@<?php echo strtolower(htmlspecialchars($data['username'])); ?></p>
      <p><em><?php echo $data['bio'] ? htmlspecialchars($data['bio']) : 'Belum ada bio.'; ?></em></p>
      <a href="edit_profile.php" class="btn btn-outline-light btn-sm mt-2">Edit Profile</a>
    </div>

    <!-- ✅ Bungkus dengan .row agar sejajar -->
    <div class="row g-3">
      <div class="col-md-6">
        <div class="profile-card h-100">
          <h5 class="mb-3">Achievements</h5>
          <div id="achievementCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php
              $sql_achievements = "
          SELECT a.nama, a.syarat
          FROM user_achievements ua
          JOIN achievements a ON ua.id_achievement = a.id_achievement
          WHERE ua.id_user = $id_user
        ";
              $res_achievements = mysqli_query($koneksi, $sql_achievements);
              $activeSet = false;
              if (mysqli_num_rows($res_achievements) > 0):
                while ($row = mysqli_fetch_assoc($res_achievements)):
              ?>
                  <div class="carousel-item <?php if (!$activeSet) {
                                              echo 'active';
                                              $activeSet = true;
                                            } ?>">
                    <div class="achievement-card text-white">
                      <h6>🏅 <?php echo htmlspecialchars($row['nama']); ?></h6>
                      <p class="small mb-0">🔍 <?php echo htmlspecialchars($row['syarat']); ?></p>
                    </div>
                  </div>
                <?php endwhile;
              else: ?>
                <div class="carousel-item active">
                  <div class="achievement-card text-muted">
                    <p class="mb-0">Belum ada pencapaian.</p>
                  </div>
                </div>
              <?php endif; ?>
            </div>

            <!-- Tombol panah -->
            <button class="carousel-control-prev" type="button" data-bs-target="#achievementCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#achievementCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </div>


      <!-- Level -->
      <!-- Level dan Rank -->
      <div class="col-md-6">
        <div class="profile-card">
          <h5 class="mb-3">Level</h5>
          <p><strong>Level <?php echo $data['level']; ?></strong></p>
          <?php
          $progress = ($data['xp'] / $data['xp_next']) * 100;
          $progress = $progress > 100 ? 100 : $progress;
          ?>
          <div class="progress">
            <div class="progress-bar bg-info" style="width: <?php echo $progress; ?>%">
              <?php echo round($progress); ?>% to next
            </div>
          </div>

          <!-- Rank -->
          <p class="mt-3">
            <?php
            $rank = 'Bronze';
            if ($data['level'] >= 20) $rank = 'Diamond';
            elseif ($data['level'] >= 15) $rank = 'Platinum';
            elseif ($data['level'] >= 10) $rank = 'Gold';
            elseif ($data['level'] >= 5) $rank = 'Silver';

            $rank_color = [
              'Bronze' => '#cd7f32',
              'Silver' => '#c0c0c0',
              'Gold' => '#ffd700',
              'Platinum' => '#e5e4e2',
              'Diamond' => '#b9f2ff'
            ];
            ?>
            <strong style="color: <?php echo $rank_color[$rank]; ?>;">
              🏆 <?php echo $rank; ?> Rank
            </strong>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>