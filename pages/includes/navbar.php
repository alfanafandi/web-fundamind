<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top border-bottom border-secondary">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center w-100">
      <!-- Brand -->
      <a class="navbar-brand fw-bold fs-5 text-white me-5 ps-2" href="dashboard.php">Fundamind</a>

      <!-- Menu utama -->
      <ul class="navbar-nav mb-2 mb-lg-0 gap-3 flex-row flex-wrap">
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="guild.php">Guild</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="profile.php">Profile</a>
        </li>
      </ul>

      <!-- Avatar + Dropdown hanya di desktop -->
      <div class="d-none d-lg-block ms-auto">
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../assets/images/<?php echo $_SESSION['avatar'] ?? 'default-avatar.png'; ?>"
                   alt="avatar"
                   width="46"
                   height="46"
                   class="rounded-circle"
                   style="object-fit: cover; border: 2px solid #6c757d;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow" aria-labelledby="dropdownUser">
              <li class="px-3 py-2 text-white">
                👋 Halo, <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Pengguna'); ?></strong>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="profile.php">👤 Lihat Profil</a></li>
              <li><a class="dropdown-item text-danger" href="logout.php">🚪 Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-light fw-bold px-4 py-2">Login</a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Toggler untuk mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
