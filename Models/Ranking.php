<?php

namespace Models;

require_once 'Database.php';

class Ranking
{
    private $db;

    function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    function hitungRanking($rentang_waktu)
    {
        // Query untuk mengambil data penilaian berdasarkan rentang waktu
        $query = "SELECT k.nama_karyawan, kr.nama_kriteria, kr.atribut, kr.bobot, p.nilai
                  FROM penilaian p
                  JOIN karyawan k ON p.id_karyawan = k.id_karyawan
                  JOIN kriteria kr ON p.id_kriteria = kr.id_kriteria
                  WHERE DATE_FORMAT(p.tanggal_penilaian, '%Y-%m') = '$rentang_waktu'
                  ORDER BY k.id_karyawan, kr.id_kriteria";

        $data = mysqli_query($this->db, $query);

        if (!$data) {
            return false; // Kembalikan false jika query gagal
        }

        // Array untuk menyimpan data-data yang diperlukan
        $originalMatrix = array();
        $minValues = array();
        $maxValues = array();
        $attributMapping = array();
        $weights = array();

        // Iterasi untuk memproses hasil query
        while ($row = mysqli_fetch_assoc($data)) {
            $originalMatrix[$row['nama_karyawan']][$row['nama_kriteria']] = $row['nilai'];

            // Perhitungan nilai minimum dan maksimum untuk normalisasi
            if (!isset($minValues[$row['nama_kriteria']]) || $row['nilai'] < $minValues[$row['nama_kriteria']]) {
                $minValues[$row['nama_kriteria']] = $row['nilai'];
            }

            if (!isset($maxValues[$row['nama_kriteria']]) || $row['nilai'] > $maxValues[$row['nama_kriteria']]) {
                $maxValues[$row['nama_kriteria']] = $row['nilai'];
            }

            // Mapping atribut dan bobot kriteria
            $attributMapping[$row['nama_kriteria']] = $row['atribut'];
            $weights[$row['nama_kriteria']] = $row['bobot'];
        }

        // Kembalikan array dengan data-data yang diperlukan
        return array(
            'originalMatrix' => $originalMatrix,
            'minValues' => $minValues,
            'maxValues' => $maxValues,
            'attributMapping' => $attributMapping,
            'weights' => $weights
        );
    }
}
