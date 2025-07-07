<?php
class BossQuestModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        $sql = "SELECT * FROM boss_quests ORDER BY id_boss ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM boss_quests WHERE id_boss = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $id_quest = (int)$data['id_quest'];
        $nama_boss = mysqli_real_escape_string($this->conn, $data['nama_boss']);
        $chapter_start = (int)$data['chapter_start'];
        $chapter_end = (int)$data['chapter_end'];
        $deskripsi_boss = mysqli_real_escape_string($this->conn, $data['deskripsi_boss']);
        $background_image = mysqli_real_escape_string($this->conn, $data['background_image']);
        $boss_image = mysqli_real_escape_string($this->conn, $data['boss_image']);
        $xp_reward = (int)$data['xp_reward'];
        $coin_reward = (int)$data['coin_reward'];
        $sql = "INSERT INTO boss_quests (id_quest, nama_boss, chapter_start, chapter_end, deskripsi_boss, background_image, boss_image, xp_reward, coin_reward)
                VALUES ($id_quest, '$nama_boss', $chapter_start, $chapter_end, '$deskripsi_boss', '$background_image', '$boss_image', $xp_reward, $coin_reward)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $id_quest = (int)$data['id_quest'];
        $nama_boss = mysqli_real_escape_string($this->conn, $data['nama_boss']);
        $chapter_start = (int)$data['chapter_start'];
        $chapter_end = (int)$data['chapter_end'];
        $deskripsi_boss = mysqli_real_escape_string($this->conn, $data['deskripsi_boss']);
        $background_image = mysqli_real_escape_string($this->conn, $data['background_image']);
        $boss_image = mysqli_real_escape_string($this->conn, $data['boss_image']);
        $xp_reward = (int)$data['xp_reward'];
        $coin_reward = (int)$data['coin_reward'];
        $sql = "UPDATE boss_quests SET 
                    id_quest = $id_quest,
                    nama_boss = '$nama_boss',
                    chapter_start = $chapter_start,
                    chapter_end = $chapter_end,
                    deskripsi_boss = '$deskripsi_boss',
                    background_image = '$background_image',
                    boss_image = '$boss_image',
                    xp_reward = $xp_reward,
                    coin_reward = $coin_reward
                WHERE id_boss = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM boss_quests WHERE id_boss = $id";
        return mysqli_query($this->conn, $sql);
    }
}
