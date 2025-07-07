<?php
include_once 'pages/db.php';
include_once 'models/quest_question_model.php';

class QuestQuestionController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new QuestQuestionModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $questions = $this->model->getAll();
                include 'pages/admin/quest_question_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->create($_POST);
                    header('Location: index.php?modul=quest_question&fitur=list');
                    exit;
                }
                include 'pages/admin/quest_question_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=quest_question&fitur=list');
                    exit;
                }
                $question = $this->model->getById($id);
                if (!$question) {
                    echo "Question tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/quest_question_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=quest_question&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul quest_question.";
        }
    }
}
