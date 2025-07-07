<?php
class ChallengeScoresModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        $sql = "SELECT * FROM challenge_scores ORDER BY id DESC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM challenge_scores WHERE id = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $id_user = (int)$data['id_user'];
        $score = (int)$data['score'];
        $waktu = mysqli_real_escape_string($this->conn, $data['waktu']);
        $sql = "INSERT INTO challenge_scores (id_user, score, waktu) VALUES ($id_user, $score, '$waktu')";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $id_user = (int)$data['id_user'];
        $score = (int)$data['score'];
        $waktu = mysqli_real_escape_string($this->conn, $data['waktu']);
        $sql = "UPDATE challenge_scores SET id_user = $id_user, score = $score, waktu = '$waktu' WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM challenge_scores WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }
}
