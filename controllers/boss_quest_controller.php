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
                    $this->model->create($_POST);
                    header('Location: index.php?modul=boss_quest&fitur=list');
                    exit;
                }
                include 'pages/admin/boss_quest_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=boss_quest&fitur=list');
                    exit;
                }
                $boss = $this->model->getById($id);
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
