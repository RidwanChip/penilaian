<?php
include 'Models/Admin.php';

use Models\Admin;


$db = new Admin();

$aksi = $_GET['aksi'];
if ($aksi == "login") {
    $db->login(
        $_POST['username'],
        $_POST['password'],
    );
    header("location: ../penilaian/page.php?q=home");
} else {
    $_SESSION['failed'] = "Username atau Password salah !";
    header("Location: ../penilaian/login.php");
}
