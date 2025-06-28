<?php
class User
{
    private $conn;

    public function __construct($koneksi)
    {
        $this->conn = $koneksi;
    }

    public function getAll()
    {
        $sql = "SELECT id_user, username, level FROM users";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM users WHERE id_user = $id";
        return mysqli_fetch_assoc(mysqli_query($this->conn, $sql));
    }

    public function create($data)
    {
        $username = mysqli_real_escape_string($this->conn, $data['username']);
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $level = (int)$data['level'];

        $sql = "INSERT INTO users (username, password, level) 
                VALUES ('$username', '$password', $level)";
        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $data)
    {
        $id = (int)$id;
        $username = mysqli_real_escape_string($this->conn, $data['username']);
        $level = (int)$data['level'];
        $coin = (int)$data['coin'];

        $sql = "UPDATE users SET username='$username', level=$level, coin=$coin WHERE id_user=$id";

        return mysqli_query($this->conn, $sql);
    }


    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM users WHERE id_user = $id";
        return mysqli_query($this->conn, $sql);
    }
}
