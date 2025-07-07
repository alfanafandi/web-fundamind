<?php
include_once 'pages/db.php';
include_once 'models/quest_chapter_model.php';

class QuestChapterController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new QuestChapterModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $chapters = $this->model->getAll();
                include 'pages/admin/quest_chapter_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->create($_POST);
                    header('Location: index.php?modul=quest_chapter&fitur=list');
                    exit;
                }
                include 'pages/admin/quest_chapter_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=quest_chapter&fitur=list');
                    exit;
                }
                $chapter = $this->model->getById($id);
                if (!$chapter) {
                    echo "Chapter tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/quest_chapter_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=quest_chapter&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul quest_chapter.";
        }
    }
}
