<?php
class QuestModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        $sql = "SELECT * FROM quests WHERE tersedia = 1 ORDER BY id_quest ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getByKategori($kategori) {
        $kategori = mysqli_real_escape_string($this->conn, $kategori);
        $sql = "SELECT * FROM quests WHERE kategori = '$kategori' AND tersedia = 1 ORDER BY id_quest ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM quests WHERE id_quest = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data) {
        $judul = mysqli_real_escape_string($this->conn, $data['judul']);
        $deskripsi = mysqli_real_escape_string($this->conn, $data['deskripsi']);
        $kategori = mysqli_real_escape_string($this->conn, $data['kategori']);
        $xp = (int)$data['xp_reward'];
        $coin = (int)$data['coin_reward'];
        $icon = mysqli_real_escape_string($this->conn, $data['gambar_icon']);
        $tersedia = (int)($data['tersedia'] ?? 1);
        $mulai = !empty($data['mulai_event']) ? "'" . mysqli_real_escape_string($this->conn, $data['mulai_event']) . "'" : "NULL";
        $akhir = !empty($data['akhir_event']) ? "'" . mysqli_real_escape_string($this->conn, $data['akhir_event']) . "'" : "NULL";

        $sql = "INSERT INTO quests (judul, deskripsi, kategori, xp_reward, coin_reward, gambar_icon, tersedia, mulai_event, akhir_event)
                VALUES ('$judul', '$deskripsi', '$kategori', $xp, $coin, '$icon', $tersedia, $mulai, $akhir)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data) {
        $id          = (int)$id;
        $judul       = mysqli_real_escape_string($this->conn, $data['judul']);
        $kategori    = mysqli_real_escape_string($this->conn, $data['kategori']);
        $xp_reward   = (int)$data['xp_reward'];
        $coin_reward = (int)$data['coin_reward'];
        $gambar_icon = mysqli_real_escape_string($this->conn, $data['gambar_icon']);
        $tersedia    = isset($data['tersedia']) ? (int)$data['tersedia'] : 1;

        $query = "UPDATE quests SET 
                    judul       = '$judul',
                    kategori    = '$kategori',
                    xp_reward   = $xp_reward,
                    coin_reward = $coin_reward,
                    gambar_icon = '$gambar_icon',
                    tersedia    = $tersedia
                  WHERE id_quest = $id";

        return mysqli_query($this->conn, $query);
    }

    public function delete($id) {
        $id = (int)$id;
        $sql = "DELETE FROM quests WHERE id_quest = $id";
        return mysqli_query($this->conn, $sql);
    }
}
