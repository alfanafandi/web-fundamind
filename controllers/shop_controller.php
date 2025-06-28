<?php
include_once 'pages/db.php';
include_once 'models/shop_model.php';

class ShopController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new ShopModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $items = $this->model->getAll();
                include 'pages/admin/shop_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->create($_POST);
                    header('Location: index.php?modul=shop&fitur=list');
                    exit;
                }
                include 'pages/admin/shop_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                $item = $this->model->getById($id);
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=shop&fitur=list');
                    exit;
                }
                include 'pages/admin/shop_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=shop&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan.";
        }
    }
}
