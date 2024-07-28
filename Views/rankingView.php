<?php
include 'Models/Ranking.php';

use Models\Ranking;

$db = new Ranking();
Auth();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected time range from the form
    $rentang_waktu = $_POST['rentang_waktu'];
} else {
    // Default to the current month if no time range is selected
    $rentang_waktu = date('Y-m');
}
?>

<h2 class='mt-3'>Hasil dan Pemeringkatan Karyawan</h2>
</form>
<form action='' method='post' class='mt-3'>
    <div class='form row'>
        <div class='col col-lg-4 col-md-4 mb-3'>
            <input type='month' name='rentang_waktu' value='<?php echo $rentang_waktu ?>' class='form-control' required>
        </div>
        <div class='col col-lg-4 col-md-4 mb-3'>
            <button type='submit' class='btn btn-primary'>Tampilkan Penilaian</button>
            <a href="../penilaian/page.php?q=rankReport&rentang_waktu=<?php echo $rentang_waktu; ?>" class="btn btn-warning text-dark" target="_blank">Unduh Laporan</a>
        </div>
    </div>
</form>

<?php
// Buat objek model Ranking

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

    // Tampilkan data jika ada
    if (!empty($originalMatrix)) { ?>

        <h2>Matriks Keputusan</h2>
        <div class='table-responsive'>
            <table class='table table-striped table-bordered' border="1">
                <tr>
                    <th>Nama Karyawan</th>
                    <?php
                    // Ambil nama kriteria dari baris pertama hasil
                    $kriteria_names = array_keys(reset($originalMatrix));
                    foreach ($kriteria_names as $kriteria) {
                    ?>
                        <th><?php echo $kriteria ?></th>
                    <?php
                    }
                    ?>
                </tr>
                <?php
                // Tampilkan data nilai
                foreach ($originalMatrix as $karyawan => $nilai) {
                ?><tr>
                        <td><?php echo $karyawan ?></td>
                        <?php
                        foreach ($nilai as $nilai_kriteria) {
                        ?>
                            <td><?php echo $nilai_kriteria ?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>


        <?php
        // Populate and display normalized data rows
        foreach ($originalMatrix as $karyawan => $nilai) {
            foreach ($nilai as $kriteria => $nilai_kriteria) {
                $normalizedValue = $nilai_kriteria / $maxValues[$kriteria];
                $benefitMatrix[$karyawan][$kriteria] = $normalizedValue;
            }
        }
        // Populate and display new data rows
        foreach ($originalMatrix as $karyawan => $nilai) {
            foreach ($nilai as $kriteria => $nilai_kriteria) {
                $newValue = $minValues[$kriteria] / $nilai_kriteria;
                $costMatrix[$karyawan][$kriteria] = $newValue;
            }
        }
        ?>

        <h2>Normalisasi Matriks</h2>
        <div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <tr>
                    <th>Nama Karyawan</th>
                    <?php
                    // Display header row with criteria names
                    foreach (array_keys(reset($originalMatrix)) as $kriteria) {
                    ?>
                        <th><?php echo $kriteria ?></th>
                    <?php
                    }
                    ?>
                </tr>
                <?php
                // Populate and display combined data rows
                foreach ($originalMatrix as $karyawan => $nilai) {
                ?><tr>
                        <td><?php echo $karyawan ?></td>
                        <?php
                        foreach ($nilai as $kriteria => $nilai_kriteria) {
                            // Check the attribut for each criteria and combine values accordingly
                            if ($attributMapping[$kriteria] == 'benefit') {
                                $combinedValue = $benefitMatrix[$karyawan][$kriteria];
                            } elseif ($attributMapping[$kriteria] == 'cost') {
                                $combinedValue = $costMatrix[$karyawan][$kriteria];
                            } else {
                                $combinedValue = ''; // Handle other cases as needed
                            }
                            echo "<td>" . number_format($combinedValue, 3) . "</td>";
                        }
                        ?>

                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <h2>Nilai Preferensi (V)</h2>
        <div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <tr>
                    <th>Nama Karyawan</th>

                    <?php
                    foreach (array_keys(reset($originalMatrix)) as $kriteria) {
                    ?>
                        <th><?php echo $kriteria ?></th>
                    <?php
                    }
                    ?>
                </tr>
                <?php
                // Populate and display weighted value matrix
                foreach ($originalMatrix as $karyawan => $nilai) {
                ?>
                    <tr>
                        <td><?php echo $karyawan ?></td>
                        <?php
                        foreach ($nilai as $kriteria => $nilai_kriteria) {
                            // Check the attribut for each criteria and combine values accordingly
                            if ($attributMapping[$kriteria] == 'benefit') {
                                $combinedValue = $benefitMatrix[$karyawan][$kriteria];
                            } elseif ($attributMapping[$kriteria] == 'cost') {
                                $combinedValue = $costMatrix[$karyawan][$kriteria];
                            } else {
                                $combinedValue = ''; // Handle other cases as needed
                            }

                            // Calculate and store the weighted value
                            $weightedValue = $combinedValue * $weights[$kriteria];
                            $weightedValueMatrix[$karyawan][$kriteria] = $weightedValue;

                            echo "<td>" . number_format($weightedValue, 3) . "</td>";
                        }
                        ?>

                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <h2>Hasil Nilai</h2>
        <div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Hasil Akhir</th>
                </tr>
                <?php
                // Calculate and display final result for each row
                foreach ($originalMatrix as $karyawan => $nilai) {
                    $finalResult = 0;
                ?>
                    <tr>
                        <td><?php echo $karyawan ?></td>
                        <?php
                        foreach ($nilai as $kriteria => $nilai_kriteria) {
                            // Check the attribut for each criteria and combine values accordingly
                            if ($attributMapping[$kriteria] == 'benefit') {
                                $combinedValue = $benefitMatrix[$karyawan][$kriteria];
                            } elseif ($attributMapping[$kriteria] == 'cost') {
                                $combinedValue = $costMatrix[$karyawan][$kriteria];
                            } else {
                                $combinedValue = ''; // Handle other cases as needed
                            }

                            $finalResult += $combinedValue * $weights[$kriteria];
                        }

                        echo "<td>" . number_format($finalResult, 3) . "</td>";
                        ?>
                    </tr>
                <?php
                    // Store final result for ranking

                    $finalResultsArray[$karyawan] = number_format($finalResult, 3);
                }
                ?>
            </table>
        </div>
        <?php
        // Calculate ranking based on final result
        arsort($finalResultsArray);
        ?>
        <h2>Pemeringkatan</h2>
        <div class='table-responsive'>
            <table class='table table-striped table-bordered'>
                <tr>
                    <th>Rank</th>
                    <th>Nama Karyawan</th>
                    <th>Hasil Akhir</th>
                </tr>
                <?php
                $rank = 1;
                foreach ($finalResultsArray as $karyawan => $finalResult) {
                ?>
                    <tr>
                        <td><?php echo $rank ?></td>
                        <td><?php echo $karyawan ?></td>
                        <td><?php echo $finalResult ?></td>
                    </tr>
                <?php
                    $rank++;
                }
                ?>
            </table>
        </div>
<?php
    } else {
        echo "Belum ada data untuk ditampilkan.";
    }
} else {
    echo "Belum ada Perankingan untuk rentang waktu ini.";
}
