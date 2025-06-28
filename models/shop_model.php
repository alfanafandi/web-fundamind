<?php

class ShopModel {
    private $conn;

    public function __construct($koneksi) {
        $this->conn = $koneksi;
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM shop_items WHERE tersedia = 1 ORDER BY id_item ASC");
    }

    public function getById($id) {
        $id = (int)$id;
        return mysqli_fetch_assoc(mysqli_query($this->conn, "SELECT * FROM shop_items WHERE id_item = $id"));
    }

    public function create($data) {
        $nama = mysqli_real_escape_string($this->conn, $data['nama_item']);
        $tipe = mysqli_real_escape_string($this->conn, $data['tipe_item']);
        $deskripsi = mysqli_real_escape_string($this->conn, $data['deskripsi']);
        $harga = (int)$data['harga_coin'];
        $file = mysqli_real_escape_string($this->conn, $data['file_icon']);
        $efek = mysqli_real_escape_string($this->conn, $data['efek']);

        return mysqli_query($this->conn, "INSERT INTO items 
        (nama_item, tipe_item, deskripsi, harga_coin, file_icon, efek, tersedia) 
        VALUES ('$nama', '$tipe', '$deskripsi', $harga, '$file', '$efek', 1)");
    }

    public function update($id, $data) {
        $id = (int)$id;
        $nama = mysqli_real_escape_string($this->conn, $data['nama_item']);
        $tipe = mysqli_real_escape_string($this->conn, $data['tipe_item']);
        $deskripsi = mysqli_real_escape_string($this->conn, $data['deskripsi']);
        $harga = (int)$data['harga_coin'];
        $file = mysqli_real_escape_string($this->conn, $data['file_icon']);

        return mysqli_query($this->conn, "UPDATE shop_items SET 
        nama_item='$nama', tipe_item='$tipe', deskripsi='$deskripsi', 
        harga_coin=$harga, file_icon='$file' 
        WHERE id_item = $id");
    }

    public function delete($id) {
        $id = (int)$id;
        return mysqli_query($this->conn, "DELETE FROM shop_items WHERE id_item = $id");
    }
}
