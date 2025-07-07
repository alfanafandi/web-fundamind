<?php
include_once 'pages/db.php';
include_once 'models/boss_question_model.php';

class BossQuestionController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new BossQuestionModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $perPage = 10;
                $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
                $offset = ($page - 1) * $perPage;
                $totalRows = $this->model->countAll();
                $totalPages = ceil($totalRows / $perPage);
                $questions = $this->model->getAll($perPage, $offset);
                include 'pages/admin/boss_questions_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->create($_POST);
                    header('Location: index.php?modul=boss_question&fitur=list');
                    exit;
                }
                include 'pages/admin/boss_question_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=boss_question&fitur=list');
                    exit;
                }
                $question = $this->model->getById($id);
                if (!$question) {
                    echo "Boss Question tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/boss_question_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=boss_question&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul boss_question.";
        }
    }
}
