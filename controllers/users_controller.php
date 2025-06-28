<?php
include_once 'pages/db.php';
include_once 'models/users_model.php';

class UserController {
    private $userModel;

    public function __construct($koneksi) {
        $this->userModel = new User($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $users = $this->userModel->getAll();
                include 'pages/admin/users_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->userModel->create($_POST);
                    header('Location: index.php?modul=user&fitur=list');
                    exit;
                }
                include 'pages/admin/users_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? null;
                if (!$id) die("ID tidak ditemukan");

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->userModel->update($id, $_POST);
                    header('Location: index.php?modul=user&fitur=list');
                    exit;
                }
                $user = $this->userModel->getById($id);
                include 'pages/admin/users_edit.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? null;
                if ($id) {
                    $this->userModel->delete($id);
                }
                header('Location: index.php?modul=user&fitur=list');
                exit;

            default:
                echo "Fitur tidak tersedia.";
        }
    }
}
