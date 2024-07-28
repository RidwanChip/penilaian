<?php
include 'Models/Karyawan.php';

use Models\Karyawan;

$db = new Karyawan();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {
    $db->tambah_data(
        $_POST['nama_karyawan'],
        $_POST['bagian'],
        $_POST['alamat'],
        $_POST['no_hp']
    );
    $_SESSION['success'] = "Sukses Data Ditambahkan";
    header("location: ../penilaian/page.php?q=karyawanView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['id_karyawan'],
        $_POST['nama_karyawan'],
        $_POST['bagian'],
        $_POST['alamat'],
        $_POST['no_hp']
    );
    $_SESSION['success'] = "Sukses Data Diupdate";
    header("location: ../penilaian/page.php?q=karyawanView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['id_karyawan']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location: ../penilaian/page.php?q=karyawanView");
}
