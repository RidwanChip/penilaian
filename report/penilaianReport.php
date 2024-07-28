<?php
require('library/fpdf.php');
require_once 'Models/Ranking.php';
require_once 'DateID.php';

use Models\Ranking;

// Buat objek model Ranking
$db = new Ranking();

// Cek jika rentang waktu tersedia dari URL atau form
if (isset($_GET['rentang_waktu'])) {
    $rentang_waktu = $_GET['rentang_waktu'];
} else {
    $rentang_waktu = date('Y-m'); // Default ke bulan ini jika tidak ada yang dipilih
}

// Hitung ranking dengan menggunakan rentang waktu yang dipilih
$rankingData = $db->hitungRanking($rentang_waktu);

// Periksa apakah ada data yang diterima dari model
if (!empty($rankingData)) {
    // Extract data dari hasil perhitungan
    $originalMatrix = $rankingData['originalMatrix'];
    $minValues = $rankingData['minValues'];
    $maxValues = $rankingData['maxValues'];
    $attributMapping = $rankingData['attributMapping'];
    $weights = $rankingData['weights'];

    // Cek apakah matriks nilai awal tidak kosong
    if (!empty($originalMatrix)) {
        class PDF extends FPDF
        {
            // Fungsi untuk membuat header halaman
            function Header()
            {
                // Logo
                $this->Image('../penilaian/report/logo_jlm.png', 10, 5, 30);
                $namePT = "PT. Jala Lintas Media";
                // Alamat
                $address = "Jl. Raya Mayor Oking Jaya Atmaja No.89, Ciriung, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16917";

                // PT
                $this->SetFont('Arial', 'B', 20);
                $this->Cell(0, 0, $namePT, 0, 1, 'C');

                // Alamat
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 20, $address, 0, 1, 'C');

                // Garis pembatas
                $this->SetDrawColor(0, 0, 0); // Warna garis: hitam
                $this->SetLineWidth(0.5); // Ketebalan garis
                $this->Line(0, 25, 400, 25); // Garis horizontal setelah alamat

                // Judul
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Hasil Penilaian Karyawan Kontrak', 0, 1, 'C');

                // Garis bawah
                $this->Ln(1);
            }

            // Fungsi untuk menambahkan tanda tangan
            function Signature($location, $date, $name, $ket, $position)
            {
                // Mengatur posisi x dan y
                $this->SetY(-61); // Posisi Y dinaikkan agar tidak terpotong
                $this->SetX(-60);
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 10, "$location, $date", 0, 1, 'L');
                $this->SetX(-60);
                $this->Cell(0, 0, $ket, 0, 1, 'L');
                $this->SetX(-60);
                $this->Cell(0, 10, $position, 0, 1, 'L');
                $this->Ln(10); // Jarak untuk tanda tangan
                $this->SetX(-60);
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 10, $name, 0, 1, 'L');
            }
        }

        // Buat instance dari class PDF
        $pdf = new PDF();
        $pdf->AddPage();

        // Tampilkan rentang waktu
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Priode Penilaian: ' . $rentang_waktu, 0, 1, 'C');
        $pdf->Ln(1);

        // Hitung ranking berdasarkan hasil perhitungan
        $finalResultsArray = array();
        foreach ($originalMatrix as $karyawan => $nilai) {
            $finalResult = 0;
            foreach ($nilai as $kriteria => $nilai_kriteria) {
                // Hitung nilai akhir menggunakan bobot dan normalisasi
                // Disesuaikan dengan logika perhitungan SAW Anda
                if ($attributMapping[$kriteria] == 'benefit') {
                    $normalizedValue = $nilai_kriteria / $maxValues[$kriteria];
                } elseif ($attributMapping[$kriteria] == 'cost') {
                    $normalizedValue = $minValues[$kriteria] / $nilai_kriteria;
                } else {
                    $normalizedValue = 0; // Handle other cases as needed
                }
                $weightedValue = $normalizedValue * $weights[$kriteria];
                $finalResult += $weightedValue;
            }

            // Simpan hasil perhitungan untuk ranking
            $finalResultsArray[$karyawan] = $finalResult;
        }

        // Urutkan berdasarkan nilai final (dari yang tertinggi ke terendah)
        arsort($finalResultsArray);

        // Tampilkan tabel ranking
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Peringkat', 1, 0, 'C');
        $pdf->Cell(90, 10, 'Nama Karyawan', 1, 0, 'C');
        $pdf->Cell(60, 10, 'Hasil Akhir', 1, 1, 'C');

        // Tampilkan data dalam tabel PDF
        $rank = 1;
        foreach ($finalResultsArray as $karyawan => $finalResult) {
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(40, 10, $rank, 1, 0, 'C');
            $pdf->Cell(90, 10, $karyawan, 1, 0, 'C');
            $pdf->Cell(60, 10, number_format($finalResult, 3), 1, 1, 'C');
            $rank++;
        }

        // Menambahkan tanda tangan
        $date = date('Y-m-d');
        $indonesianDay = getIndonesianDay($date);
        $indonesianMonth = getIndonesianMonth($date);
        $formattedDate = $indonesianDay . ' ' . date('d ') . $indonesianMonth . date(' Y'); // Format: Hari, Tanggal Bulan Tahun
        $pdf->Signature('Bogor', $formattedDate, 'Fristiandi Nugroho', 'Mengetahui,', 'Manager HR');

        // Output file PDF
        ob_clean();
        $pdf->Output('D', 'Laporan_Penilaian_' . $rentang_waktu . '.pdf');
    } else {
        echo "<br>Belum ada data untuk diunduh.";
    }
} else {
    echo  "Belum ada Perankingan untuk rentang waktu ini.";
}
