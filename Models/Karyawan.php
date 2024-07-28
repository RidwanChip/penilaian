<?php

namespace Models;

require_once 'Database.php';

class Karyawan
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT * FROM karyawan");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function tambah_data($nama_karyawan, $bagian, $alamat, $no_hp)
    {
        mysqli_query($this->db, "INSERT INTO karyawan VALUES (NULL ,'$nama_karyawan','$bagian','$alamat','$no_hp')");
    }

    function edit_data($id_karyawan)
    {
        $data = mysqli_query($this->db, "SELECT * FROM karyawan WHERE id_karyawan='$id_karyawan'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }

    function update_data($id_karyawan, $nama_karyawan, $bagian, $alamat, $no_hp)
    {
        mysqli_query($this->db, "UPDATE karyawan SET nama_karyawan = '$nama_karyawan', bagian = '$bagian', alamat = '$alamat', no_hp = '$no_hp' WHERE id_karyawan ='$id_karyawan' ");
    }

    function hapus_data($id_karyawan)
    {
        mysqli_query($this->db, "DELETE FROM karyawan WHERE id_karyawan = '$id_karyawan' ");
    }
}
