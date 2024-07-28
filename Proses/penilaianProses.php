<?php
include 'Models/Penilaian.php';
require_once '../penilaian/Database.php';

use Models\Penilaian;

$db = new Penilaian();

use Models\Database;

// Create a new instance of the Database class
$database = new Database();

// Attempt to establish a database connection
$conn = $database->getConnection();

$aksi = $_GET['aksi'];
if ($aksi == "tambah") {

    $db->tambah_data(
        $_POST['id_penilaian'],
        $_POST['id_karyawan'],
        $_POST['id_kriteria'],
        $_POST['nilai'],
        $_POST['tanggal_penilaian']
    );
    header("location:  ../penilaian/page.php?q=penilaianView");
} elseif ($aksi == "update") {
    $db->update_data(
        $_POST['id_penilaian'],
        $_POST['id_karyawan'],
        $_POST['id_kriteria'],
        $_POST['nilai'],
        $_POST['tanggal_penilaian']
    );
    header("location:  ../penilaian/page.php?q=penilaianView");
} elseif ($aksi == "hapus_data") {
    $db->hapus_data($_GET['id_karyawan'], $_GET['tanggal_penilaian']);
    $_SESSION['success'] = "Sukses Data Dihapus";
    header("location:  ../penilaian/page.php?q=penilaianView");
} elseif ($aksi == "tambah_penilaian") {
    // Validasi apakah penilaian sudah ada pada bulan dan tahun yang sama
    $id_karyawan = $_POST['id_karyawan'];
    $bulan_tahun_penilaian = date('Y-m', strtotime($_POST['tanggal_penilaian']));
    $tanggal_penilaian_lengkap = date('Y-m-d', strtotime($bulan_tahun_penilaian . '-' . date('d')));

    $sql_check_existing = "SELECT COUNT(*) AS count_existing FROM penilaian WHERE id_karyawan = '$id_karyawan' AND DATE_FORMAT(tanggal_penilaian, '%Y-%m') = '$bulan_tahun_penilaian'";
    $result_check_existing = $database->conn->query($sql_check_existing);
    $count_existing = $result_check_existing->fetch_assoc()['count_existing'];

    if ($count_existing > 0) {
        $_SESSION['failed'] = "Penilaian sudah ada pada bulan dan tahun yang sama.";
        header("Location: ../penilaian/page.php?q=penilaianView");
        exit();
    }

    // Jika validasi sukses, lanjutkan dengan penyimpanan data penilaian
    foreach ($_POST['id_kriteria'] as $id_kriteria) {
        $nilai = $_POST['nilai' . $id_kriteria];
        $tanggal_penilaian = $tanggal_penilaian_lengkap;
        $db->tambah_data(NULL, $id_karyawan, $id_kriteria, $nilai, $tanggal_penilaian);
    }

    $_SESSION['success'] = "Penilaian berhasil ditambahkan";
    header("Location: ../penilaian/page.php?q=penilaianView");
    exit();
}
