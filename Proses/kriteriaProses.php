<?php
include 'Models/Kriteria.php';

use Models\Kriteria;

$db = new Kriteria();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {

    $db->tambah_data(
        $_POST['nama_kriteria'],
        $_POST['atribut'],
        $_POST['bobot']
    );
    $_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../penilaian/page.php?q=kriteriaView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['id_kriteria'],
        $_POST['nama_kriteria'],
        $_POST['atribut'],
        $_POST['bobot']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../penilaian/page.php?q=kriteriaView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['id_kriteria']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../penilaian/page.php?q=kriteriaView");
}
