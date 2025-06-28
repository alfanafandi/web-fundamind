<?php
class Achievement {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM achievements ORDER BY id_achievement ASC";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $id = intval($id);
        $query = "SELECT * FROM achievements WHERE id_achievement = $id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    public function create($data) {
        $nama = mysqli_real_escape_string($this->conn, $data['nama']);
        $syarat = mysqli_real_escape_string($this->conn, $data['syarat']);

        $query = "INSERT INTO achievements (nama, syarat) VALUES ('$nama', '$syarat')";
        return mysqli_query($this->conn, $query);
    }

    public function update($id, $data) {
        $id = intval($id);
        $nama = mysqli_real_escape_string($this->conn, $data['nama']);
        $syarat = mysqli_real_escape_string($this->conn, $data['syarat']);

        $query = "UPDATE achievements SET nama='$nama', syarat='$syarat' WHERE id_achievement=$id";
        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = intval($id);
        $query = "DELETE FROM achievements WHERE id_achievement = $id";
        return mysqli_query($this->conn, $query);
    }
}
