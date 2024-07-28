<?php

namespace Models;

require_once 'Database.php';

class Penilaian
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT
        p.id_penilaian,
        k.id_karyawan, 
        k.nama_karyawan,
        kr.nama_kriteria,
        p.nilai,
        p.tanggal_penilaian
        FROM 
        penilaian p
        INNER JOIN 
        karyawan k ON p.id_karyawan = k.id_karyawan
        INNER JOIN 
        kriteria kr ON p.id_kriteria = kr.id_kriteria;");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }
    function tambah_data($id_penilaian, $id_karyawan, $id_kriteria, $nilai, $tanggal_penilaian)
    {
        mysqli_query($this->db, "INSERT INTO penilaian
        VALUES (NULL ,'$id_karyawan','$id_kriteria','$nilai','$tanggal_penilaian')");
    }
    function edit_data($id_penilaian)
    {
        $data = mysqli_query($this->db, "SELECT p.*, kr.atribut, kr.nama_kriteria, k.nama_karyawan 
        FROM penilaian p
        INNER JOIN kriteria kr ON p.id_kriteria = kr.id_kriteria
        INNER JOIN karyawan k ON p.id_karyawan = k.id_karyawan
        WHERE p.id_penilaian='$id_penilaian'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }
    function update_data($id_penilaian, $id_karyawan, $id_kriteria, $nilai, $tanggal_penilaian)
    {
        mysqli_query($this->db, "UPDATE penilaian SET nilai = '$nilai' WHERE id_penilaian ='$id_penilaian' ");
    }
    function hapus_data($id_karyawan, $tanggal_penilaian)
    {
        mysqli_query($this->db, "DELETE FROM penilaian WHERE id_karyawan = '$id_karyawan' AND tanggal_penilaian = '$tanggal_penilaian' ");
    }
    function tampil_kriteria()
    {
        $data = mysqli_query($this->db, "SELECT * FROM kriteria");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
        return $row;
    }
    function cek_penilaian_bulanan($id_karyawan)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $sql = "SELECT COUNT(*) as count FROM penilaian WHERE id_karyawan = '$id_karyawan' AND MONTH(tanggal_penilaian) = '$bulan' AND YEAR(tanggal_penilaian) = '$tahun'";
        $result = mysqli_query($this->db, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }
}
