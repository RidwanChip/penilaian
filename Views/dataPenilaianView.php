<?php
// Include file koneksi
include 'Models/Penilaian.php';

use Models\Penilaian;

use Models\Database;

// Create a new instance of the Database class
$database = new Database();
$db = new Penilaian();

$conn = $database->getConnection();
// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Tentukan jumlah data per halaman
$jumlah_per_halaman = 2;

// Tentukan halaman saat ini
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Ambil informasi rentang waktu dari formulir atau dari sesi, dan gunakan nilai default sebagai bulan dan tahun saat ini
$rentang_waktu = isset($_POST['rentang_waktu']) ? $_POST['rentang_waktu'] : (isset($_SESSION['rentang_waktu']) ? $_SESSION['rentang_waktu'] : date('Y-m'));

// Simpan rentang waktu pada sesi
$_SESSION['rentang_waktu'] = $rentang_waktu;

// Query untuk mengambil data karyawan dengan batasan jumlah per halaman
$offset = ($halaman - 1) * $jumlah_per_halaman;
$sql_karyawan = "SELECT * FROM karyawan LIMIT $offset, $jumlah_per_halaman";
$result_karyawan = $conn->query($sql_karyawan);

// Cek apakah ada data karyawan
if ($result_karyawan->num_rows > 0) {
    echo "<h2 class='mt-3'>Penilaian Karyawan</h2>";
    msg_query();
    Auth();
    // Tampilkan formulir untuk memilih rentang waktu
    echo "<form action='../routes/web.php?page=penilaian' method='post' class='mt-3'>";
    echo "<div class='form-group col-md-3 mb-3'>";
    echo "<label for='rentang_waktu'>Pilih Rentang Waktu:</label>";
    echo "</div>";
    echo "<div class='form-group col-md-3 mb-3'>";
    echo "<input type='month' name='rentang_waktu' value='$rentang_waktu' class='form-control' required>";
    echo "</div>";
    echo "<button type='submit' class='btn btn-primary mt-3'>Tampilkan Penilaian</button>";
    // <a href='../routes/web.php?page=tampil_karyawan' class='btn btn-primary mt-3'>Lihat Data Karyawan</a>
    echo "</form>";

    // Loop through each employee
    while ($row_karyawan = $result_karyawan->fetch_assoc()) {
        $id_karyawan = $row_karyawan['id_karyawan'];
        $nama_karyawan = $row_karyawan['nama_karyawan'];

        // Query to retrieve employee's assessment data based on the selected time range
        $sql_penilaian = "SELECT * FROM penilaian 
                          WHERE id_karyawan = '$id_karyawan' 
                          AND DATE_FORMAT(tanggal_penilaian, '%Y-%m') = '$rentang_waktu'";
        $result_penilaian = $conn->query($sql_penilaian);

        echo "<h3 class='mt-5'>Hasil Penilaian Karyawan: $nama_karyawan</h3>";

        // Check if there is assessment data
        if ($result_penilaian->num_rows > 0) {
            echo "<table class='table mt-3'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th scope='col'>Nama Kriteria</th>";
            echo "<th scope='col'>Nilai</th>";
            echo "<th scope='col'>Keterangan</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Loop through each assessment record
            while ($row_penilaian = $result_penilaian->fetch_assoc()) {
                $id_kriteria = $row_penilaian['id_kriteria'];
                $nilai = $row_penilaian['nilai'];

                // Query to retrieve criterion name
                $sql_kriteria = "SELECT nama_kriteria, atribut FROM kriteria WHERE id_kriteria = '$id_kriteria'";
                $result_kriteria = $conn->query($sql_kriteria);

                if ($result_kriteria->num_rows > 0) {
                    $row_kriteria = $result_kriteria->fetch_assoc();
                    $nama_kriteria = $row_kriteria['nama_kriteria'];
                    $atribut_kriteria = $row_kriteria['atribut'];

                    // Add explanation based on value and attribute
                    $keterangan = '';
                    if ($atribut_kriteria == 'benefit') {
                        switch ($nilai) {
                            case 4:
                                $keterangan = 'Sangat Baik';
                                break;
                            case 3:
                                $keterangan = 'Baik';
                                break;
                            case 2:
                                $keterangan = 'Cukup';
                                break;
                            case 1:
                                $keterangan = 'Kurang';
                                break;
                            default:
                                $keterangan = 'Nilai tidak valid';
                                break;
                        }
                    } elseif ($atribut_kriteria == 'cost') {
                        switch ($nilai) {
                            case 1:
                                $keterangan = 'Sangat Baik';
                                break;
                            case 2:
                                $keterangan = 'Baik';
                                break;
                            case 3:
                                $keterangan = 'Cukup';
                                break;
                            case 4:
                                $keterangan = 'Kurang';
                                break;
                            default:
                                $keterangan = 'Nilai tidak valid';
                                break;
                        }
                    }

                    // Display the assessment data
                    echo "<tr>";
                    echo "<td>$nama_kriteria</td>";
                    echo "<td>$nilai</td>";
                    echo "<td>$keterangan</td>";
                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            // If there is no assessment data, provide a link to add assessment
            echo "<p>Belum ada data penilaian untuk karyawan ini pada rentang waktu ini.</p>";
            echo "<a href='../routes/web.php?page=tambah_penilaian&id_karyawan=$id_karyawan&rentang_waktu=$rentang_waktu' class='btn btn-primary'>Tambahkan Penilaian</a>";
        }
    }

    // Display pagination navigation buttons
    $sql_total_karyawan = "SELECT COUNT(*) AS total FROM karyawan";
    $result_total_karyawan = $conn->query($sql_total_karyawan);
    $total_karyawan = $result_total_karyawan->fetch_assoc()['total'];
    $total_halaman = ceil($total_karyawan / $jumlah_per_halaman);

    echo "<nav aria-label='Page navigation'>";
    echo "<ul class='pagination justify-content-center mt-3'>";
    for ($i = 1; $i <= $total_halaman; $i++) {
        // Modify the URL by adding the rentang_waktu parameter
        echo "<li class='page-item " . ($i == $halaman ? 'active' : '') . "'><a class='page-link' href='../routes/web.php?page=penilaian&halaman=$i&rentang_waktu=$rentang_waktu'>$i</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
} else {
    echo "<p class='mt-5'>Tidak ada data karyawan.</p>";
}
