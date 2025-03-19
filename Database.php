<?php

namespace Models;

class Database
{
    public $host = "localhost:3307";
    public $uname = "root";
    public $pass = "";
    public $db = "penilaian_saw";
    public $conn;

    public function getConnection()
    {
        $this->conn = mysqli_connect($this->host, $this->uname, $this->pass);
        mysqli_select_db($this->conn, $this->db);
        return $this->conn;
    }
}
