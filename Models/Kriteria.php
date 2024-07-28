<?php

namespace Models;

require_once 'Database.php';
class Kriteria
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    function tampil_data()
    {
        $data = mysqli_query($this->db, "SELECT * FROM kriteria");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }
    function tambah_data($nama_kriteria, $atribut, $bobot)
    {
        mysqli_query($this->db, "INSERT INTO kriteria
        VALUES (NULL ,'$nama_kriteria','$atribut','$bobot')");
    }
    function edit_data($id_kriteria)
    {
        $data = mysqli_query($this->db, "SELECT * FROM kriteria WHERE id_kriteria='$id_kriteria'");
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);

        return $row;
    }
    function update_data($id_kriteria, $nama_kriteria, $atribut, $bobot)
    {
        mysqli_query($this->db, "UPDATE kriteria SET nama_kriteria = '$nama_kriteria', atribut = '$atribut', bobot = '$bobot' WHERE id_kriteria ='$id_kriteria' ");
    }
    function hapus_data($id_kriteria)
    {
        mysqli_query($this->db, "DELETE FROM kriteria WHERE id_kriteria = '$id_kriteria' ");
    }
}
