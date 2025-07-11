<?php
include_once 'pages/db.php';
include_once 'models/boss_quest_model.php';

class BossQuestController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new BossQuestModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $bosses = $this->model->getAll();
                include 'pages/admin/boss_quest_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Upload background_image
                    if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['background_image']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('boss_bg_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['background_image']['tmp_name'], $targetPath);
                            $_POST['background_image'] = $filename;
                        } else {
                            $_POST['background_image'] = '';
                        }
                    } else {
                        $_POST['background_image'] = '';
                    }
                    // Upload boss_image
                    if (isset($_FILES['boss_image']) && $_FILES['boss_image']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['boss_image']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('boss_img_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['boss_image']['tmp_name'], $targetPath);
                            $_POST['boss_image'] = $filename;
                        } else {
                            $_POST['boss_image'] = '';
                        }
                    } else {
                        $_POST['boss_image'] = '';
                    }
                    $this->model->create($_POST);
                    header('Location: index.php?modul=boss_quest&fitur=list');
                    exit;
                }
                include 'pages/admin/boss_quest_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                $boss = $this->model->getById($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Upload background_image
                    if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['background_image']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('boss_bg_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['background_image']['tmp_name'], $targetPath);
                            $_POST['background_image'] = $filename;
                        } else {
                            $_POST['background_image'] = $boss['background_image'];
                        }
                    } else {
                        $_POST['background_image'] = $boss['background_image'];
                    }
                    // Upload boss_image
                    if (isset($_FILES['boss_image']) && $_FILES['boss_image']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['boss_image']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('boss_img_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['boss_image']['tmp_name'], $targetPath);
                            $_POST['boss_image'] = $filename;
                        } else {
                            $_POST['boss_image'] = $boss['boss_image'];
                        }
                    } else {
                        $_POST['boss_image'] = $boss['boss_image'];
                    }
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=boss_quest&fitur=list');
                    exit;
                }
                if (!$boss) {
                    echo "Boss quest tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/boss_quest_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=boss_quest&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul boss_quest.";
        }
    }
}
