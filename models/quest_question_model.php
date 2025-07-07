<?php
class QuestQuestionModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        $sql = "SELECT * FROM quest_questions ORDER BY id_question ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM quest_questions WHERE id_question = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $pertanyaan = mysqli_real_escape_string($this->conn, $data['pertanyaan']);
        $pilihan_a = mysqli_real_escape_string($this->conn, $data['pilihan_a']);
        $pilihan_b = mysqli_real_escape_string($this->conn, $data['pilihan_b']);
        $pilihan_c = mysqli_real_escape_string($this->conn, $data['pilihan_c']);
        $pilihan_d = mysqli_real_escape_string($this->conn, $data['pilihan_d']);
        $jawaban_benar = mysqli_real_escape_string($this->conn, $data['jawaban_benar']);
        $petunjuk = mysqli_real_escape_string($this->conn, $data['petunjuk']);
        $min_level = (int)$data['min_level'];
        $kategori = mysqli_real_escape_string($this->conn, $data['kategori']);

        $sql = "INSERT INTO quest_questions (pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, petunjuk, min_level, kategori)
                VALUES ('$pertanyaan', '$pilihan_a', '$pilihan_b', '$pilihan_c', '$pilihan_d', '$jawaban_benar', '$petunjuk', $min_level, '$kategori')";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $pertanyaan = mysqli_real_escape_string($this->conn, $data['pertanyaan']);
        $pilihan_a = mysqli_real_escape_string($this->conn, $data['pilihan_a']);
        $pilihan_b = mysqli_real_escape_string($this->conn, $data['pilihan_b']);
        $pilihan_c = mysqli_real_escape_string($this->conn, $data['pilihan_c']);
        $pilihan_d = mysqli_real_escape_string($this->conn, $data['pilihan_d']);
        $jawaban_benar = mysqli_real_escape_string($this->conn, $data['jawaban_benar']);
        $petunjuk = mysqli_real_escape_string($this->conn, $data['petunjuk']);
        $min_level = (int)$data['min_level'];
        $kategori = mysqli_real_escape_string($this->conn, $data['kategori']);

        $sql = "UPDATE quest_questions SET 
                    pertanyaan = '$pertanyaan',
                    pilihan_a = '$pilihan_a',
                    pilihan_b = '$pilihan_b',
                    pilihan_c = '$pilihan_c',
                    pilihan_d = '$pilihan_d',
                    jawaban_benar = '$jawaban_benar',
                    petunjuk = '$petunjuk',
                    min_level = $min_level,
                    kategori = '$kategori'
                WHERE id_question = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM quest_questions WHERE id_question = $id";
        return mysqli_query($this->conn, $sql);
    }
}
