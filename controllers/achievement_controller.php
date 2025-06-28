<?php
include_once 'models/achievement_model.php';

class AchievementController {
    private $achievementModel;

    public function __construct($koneksi) {
        $this->achievementModel = new Achievement($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $achievements = $this->achievementModel->getAll();
                include 'pages/admin/achievement_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->achievementModel->create($_POST);
                    header('Location: index.php?modul=achievement&fitur=list');
                    exit;
                }
                include 'pages/admin/achievement_input.php';
                break;

            case 'edit':
                if (!isset($_GET['id'])) {
                    header('Location: index.php?modul=achievement&fitur=list');
                    exit;
                }

                $id = $_GET['id'];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->achievementModel->update($id, $_POST);
                    header('Location: index.php?modul=achievement&fitur=list');
                    exit;
                }

                $achievement = $this->achievementModel->getById($id);
                include 'pages/admin/achievement_update.php';
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $this->achievementModel->delete($_GET['id']);
                }
                header('Location: index.php?modul=achievement&fitur=list');
                exit;

            default:
                echo "Fitur tidak ditemukan.";
                break;
        }
    }
}
