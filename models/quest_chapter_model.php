<?php
class QuestChapterModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        $sql = "SELECT * FROM quest_chapters ORDER BY id_chapter ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM quest_chapters WHERE id_chapter = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $id_quest = (int)$data['id_quest'];
        $nomor_chapter = (int)$data['nomor_chapter'];
        $judul_chapter = mysqli_real_escape_string($this->conn, $data['judul_chapter']);
        $deskripsi = mysqli_real_escape_string($this->conn, $data['deskripsi']);
        $coin_reward = (int)$data['coin_reward'];
        $xp_reward = (int)$data['xp_reward'];
        $sql = "INSERT INTO quest_chapters (id_quest, nomor_chapter, judul_chapter, deskripsi, coin_reward, xp_reward) 
                VALUES ($id_quest, $nomor_chapter, '$judul_chapter', '$deskripsi', $coin_reward, $xp_reward)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id = (int)$id;
        $id_quest = (int)$data['id_quest'];
        $nomor_chapter = (int)$data['nomor_chapter'];
        $judul_chapter = mysqli_real_escape_string($this->conn, $data['judul_chapter']);
        $deskripsi = mysqli_real_escape_string($this->conn, $data['deskripsi']);
        $coin_reward = (int)$data['coin_reward'];
        $xp_reward = (int)$data['xp_reward'];
        $sql = "UPDATE quest_chapters SET 
                    id_quest = $id_quest,
                    nomor_chapter = $nomor_chapter,
                    judul_chapter = '$judul_chapter',
                    deskripsi = '$deskripsi',
                    coin_reward = $coin_reward,
                    xp_reward = $xp_reward
                WHERE id_chapter = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM quest_chapters WHERE id_chapter = $id";
        return mysqli_query($this->conn, $sql);
    }
}
