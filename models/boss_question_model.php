<?php
class BossQuestionModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll($perPage = 10, $offset = 0) {
        $sql = "SELECT * FROM boss_questions ORDER BY id_question ASC LIMIT $perPage OFFSET $offset";
        return mysqli_query($this->conn, $sql);
    }

    public function countAll() {
        $sql = "SELECT COUNT(*) as total FROM boss_questions";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result)['total'];
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM boss_questions WHERE id_question = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $id_boss = (int)$data['id_boss'];
        $pertanyaan = mysqli_real_escape_string($this->conn, $data['pertanyaan']);
        $pilihan_a = mysqli_real_escape_string($this->conn, $data['pilihan_a']);
        $pilihan_b = mysqli_real_escape_string($this->conn, $data['pilihan_b']);
        $pilihan_c = mysqli_real_escape_string($this->conn, $data['pilihan_c']);
        $pilihan_d = mysqli_real_escape_string($this->conn, $data['pilihan_d']);
        $jawaban_benar = mysqli_real_escape_string($this->conn, $data['jawaban_benar']);
        $petunjuk = mysqli_real_escape_string($this->conn, $data['petunjuk']);
        $sql = "INSERT INTO boss_questions (id_boss, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, petunjuk)
                VALUES ($id_boss, '$pertanyaan', '$pilihan_a', '$pilihan_b', '$pilihan_c', '$pilihan_d', '$jawaban_benar', '$petunjuk')";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $id_boss = (int)$data['id_boss'];
        $pertanyaan = mysqli_real_escape_string($this->conn, $data['pertanyaan']);
        $pilihan_a = mysqli_real_escape_string($this->conn, $data['pilihan_a']);
        $pilihan_b = mysqli_real_escape_string($this->conn, $data['pilihan_b']);
        $pilihan_c = mysqli_real_escape_string($this->conn, $data['pilihan_c']);
        $pilihan_d = mysqli_real_escape_string($this->conn, $data['pilihan_d']);
        $jawaban_benar = mysqli_real_escape_string($this->conn, $data['jawaban_benar']);
        $petunjuk = mysqli_real_escape_string($this->conn, $data['petunjuk']);
        $sql = "UPDATE boss_questions SET 
                    id_boss = $id_boss,
                    pertanyaan = '$pertanyaan',
                    pilihan_a = '$pilihan_a',
                    pilihan_b = '$pilihan_b',
                    pilihan_c = '$pilihan_c',
                    pilihan_d = '$pilihan_d',
                    jawaban_benar = '$jawaban_benar',
                    petunjuk = '$petunjuk'
                WHERE id_question = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM boss_questions WHERE id_question = $id";
        return mysqli_query($this->conn, $sql);
    }
}
