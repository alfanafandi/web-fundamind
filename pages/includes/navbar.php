<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top border-bottom border-secondary">
  <div class="container-fluid px-4">
    <div class="d-flex align-items-center w-100"> <!-- Added w-100 -->
      <!-- Brand with left spacing -->
      <a class="navbar-brand fw-bold fs-5 text-white me-5 ps-2" href="dashboard.php"> <!-- Added ps-2 and increased me-5 -->
        Fundamind
      </a>
      
      <!-- Navigation items -->
      <ul class="navbar-nav mb-2 mb-lg-0 gap-3">
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="guild.php">Guild</a> <!-- Changed to text-secondary and fw-normal -->
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="shop.php">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-secondary fs-6 fw-normal" href="profile.php">Profile</a>
        </li>
      </ul>

      <!-- Right-aligned elements -->
      <div class="d-flex align-items-center ms-auto gap-3">
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="dropdown">
            <a class="dropdown-toggle text-decoration-none" href="#" role="button" data-bs-toggle="dropdown">
              <img src="../assets/images/<?php echo $_SESSION['avatar'] ?? 'default-avatar.png'; ?>" 
                   alt="avatar" 
                   width="46" 
                   height="46" 
                   class="rounded-circle" 
                   style="object-fit: cover; border: 2px solid #6c757d;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><h6 class="dropdown-header fs-6"><?php echo htmlspecialchars($_SESSION['username']); ?></h6></li>
              <li><hr class="dropdown-divider m-0"></li>
              <li><a class="dropdown-item fs-6" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item text-danger fs-6" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="login.php" class="btn btn-light btn-sm px-3">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
          </a>
        <?php endif; ?>
      </div>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>