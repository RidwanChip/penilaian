<?php

namespace Models;

require_once 'Database.php';

class Widget
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    function tampil_data()
    {
        // Membuat perintah SQL untuk menghitung jumlah karyawan
        $sql = "SELECT COUNT(*) AS jumlah_karyawan FROM karyawan";

        // Menjalankan perintah SQL
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Mengambil hasil query
            $row = $result->fetch_assoc();
            return $row["jumlah_karyawan"];
        } else {
            return 0;
        }
    }
    function tampil_data_kriteria()
    {
        // Membuat perintah SQL untuk menghitung jumlah karyawan
        $sql = "SELECT COUNT(*) AS jumlah_kriteria FROM kriteria";

        // Menjalankan perintah SQL
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Mengambil hasil query
            $row = $result->fetch_assoc();
            return $row["jumlah_kriteria"];
        } else {
            return 0;
        }
    }
    function jumlahKaryawanBelumDinilaiBulanIni()
    {
        // Membuat perintah SQL untuk menghitung jumlah karyawan yang belum dinilai bulan ini
        $sql = "SELECT COUNT(*) AS jumlah_karyawan_belum_dinilai
                FROM karyawan
                WHERE id_karyawan NOT IN (
                    SELECT id_karyawan
                    FROM penilaian
                    WHERE MONTH(tanggal_penilaian) = MONTH(CURRENT_DATE())
                    AND YEAR(tanggal_penilaian) = YEAR(CURRENT_DATE())
                )";

        // Menjalankan perintah SQL
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // Mengambil hasil query
            $row = $result->fetch_assoc();
            return $row["jumlah_karyawan_belum_dinilai"];
        } else {
            return 0;
        }
    }
}
