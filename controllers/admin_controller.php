<?php
class AdminController {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'dashboard':
                $this->dashboard();
                break;
            default:
                echo "Fitur admin tidak ditemukan.";
        }
    }

    private function dashboard() {
        $userCount = mysqli_fetch_assoc(mysqli_query($this->koneksi, "SELECT COUNT(*) as total FROM users"))['total'];
        include __DIR__ . '/../pages/admin/admin_dashboard.php';
    }
}
