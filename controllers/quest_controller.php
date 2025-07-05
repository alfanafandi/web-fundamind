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
                    $this->model->create($_POST);
                    header('Location: index.php?modul=quest&fitur=list');
                    exit;
                }
                include 'pages/admin/quest_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=quest&fitur=list');
                    exit;
                }
                $quest = $this->model->getById($id);
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
