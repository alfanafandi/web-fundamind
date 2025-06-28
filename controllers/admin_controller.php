<?php
class AdminController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function handle($fitur) {
        if ($fitur === 'dashboard') {
            $this->dashboard();
        }
        
    }

    private function dashboard() {
        $userCount = mysqli_fetch_assoc(mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM users"))['total'];

        include 'pages/admin/admin_dashboard.php';
    }
}
