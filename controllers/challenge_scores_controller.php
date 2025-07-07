<?php
include_once 'pages/db.php';
include_once 'models/challenge_scores_model.php';

class ChallengeScoresController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new ChallengeScoresModel($koneksi);
    }

    public function handle($fitur) {
        switch ($fitur) {
            case 'list':
                $scores = $this->model->getAll();
                include 'pages/admin/challenge_scores_list.php';
                break;

            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->create($_POST);
                    header('Location: index.php?modul=challenge_scores&fitur=list');
                    exit;
                }
                include 'pages/admin/challenge_scores_input.php';
                break;

            case 'edit':
                $id = $_GET['id'] ?? 0;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->model->update($id, $_POST);
                    header('Location: index.php?modul=challenge_scores&fitur=list');
                    exit;
                }
                $score = $this->model->getById($id);
                if (!$score) {
                    echo "Score tidak ditemukan.";
                    exit;
                }
                include 'pages/admin/challenge_scores_update.php';
                break;

            case 'delete':
                $id = $_GET['id'] ?? 0;
                $this->model->delete($id);
                header('Location: index.php?modul=challenge_scores&fitur=list');
                exit;
                break;

            default:
                echo "Fitur tidak ditemukan di modul challenge_scores.";
        }
    }
}
