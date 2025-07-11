<?php
include_once 'pages/db.php';
include_once 'models/quest_model.php';

class QuestController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new QuestModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $quests = $this->model->getAll();
                include 'pages/admin/quest_list.php';
                break;

            case 'kategori':
                $kategori = $_GET['kategori'] ?? '';
                $quests = $this->model->getByKategori($kategori);
                include 'pages/admin/quest_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Proses upload file gambar saat create
                    if (isset($_FILES['gambar_icon']) && $_FILES['gambar_icon']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['gambar_icon']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('quest_icon_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['gambar_icon']['tmp_name'], $targetPath);
                            $_POST['gambar_icon'] = $filename;
                        } else {
                            $_POST['gambar_icon'] = 'default-avatar.png'; // fallback
                        }
                    } else {
                        $_POST['gambar_icon'] = 'default-avatar.png'; // fallback
                    }
                    $this->model->create($_POST);
                    header('Location: index.php?modul=quest&fitur=list');
                    exit;
                }
                include 'pages/admin/quest_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                $quest = $this->model->getById($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Proses upload file gambar saat edit
                    if (isset($_FILES['gambar_icon']) && $_FILES['gambar_icon']['error'] === UPLOAD_ERR_OK) {
                        $uploadDir = 'assets/images/';
                        $ext = strtolower(pathinfo($_FILES['gambar_icon']['name'], PATHINFO_EXTENSION));
                        $allowed = ['png', 'jpg', 'jpeg'];
                        if (in_array($ext, $allowed)) {
                            $filename = uniqid('quest_icon_', true) . '.' . $ext;
                            $targetPath = $uploadDir . $filename;
                            move_uploaded_file($_FILES['gambar_icon']['tmp_name'], $targetPath);
                            $_POST['gambar_icon'] = $filename;
                        } else {
                            $_POST['gambar_icon'] = $quest['gambar_icon'];
                        }
                    } else {
                        $_POST['gambar_icon'] = $quest['gambar_icon'];
                    }
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=quest&fitur=list');
                    exit;
                }
                if (!$quest) {
                    echo "Quest tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/quest_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=quest&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul quest.";
        }
    }
}
