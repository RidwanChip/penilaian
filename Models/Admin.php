<?php

namespace Models;

require_once 'Database.php';

class Admin
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function login($username, $password)
    {
        $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row["username"];
            $_SESSION['success'] = "Berhasil Login";
            header("Location: ../penilaian/page.php?q=home");
        } else {
            $_SESSION['failed'] = "Username atau Password Salah!";
            header("Location: ../penilaian/login.php");
        }
    }
}
