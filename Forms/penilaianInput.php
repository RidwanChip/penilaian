<?php

use Models\Penilaian;

require_once 'Models/Penilaian.php';

$penilaianModel = new Penilaian();
$kriteria = $penilaianModel->tampil_kriteria();

$id_karyawan = isset($_GET['id_karyawan']) ? $_GET['id_karyawan'] : null;
$nama_karyawan = isset($_GET['nama_karyawan']) ? $_GET['nama_karyawan'] : null;
$rentang_waktu = isset($_GET['rentang_waktu']) ? $_GET['rentang_waktu'] : null;
?>
<h2 class="mt-3">Tambah Penilaian</h2>
<form action="../penilaian/page.php?q=penilaianAct&aksi=tambah_penilaian" method="post">
    <div class="mb-3 mt-3">
        <label for="id_karyawan" class="form-label">ID Karyawan:</label>
        <input type="text" class="form-control" name="id_karyawan" value="<?php echo $id_karyawan; ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Nama Karyawan:</label>
        <input type="text" class="form-control" name="" value="<?php echo $nama_karyawan; ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="tanggal_penilaian" class="form-label">Tanggal Penilaian:</label>
        <input type="month" class="form-control" name="tanggal_penilaian" value="<?php echo $rentang_waktu; ?>" required>
    </div>
    <?php
    // Gunakan $kriteria yang sudah didapatkan dari objek Penilaian untuk menampilkan kriteria
    if (!empty($kriteria)) {
        foreach ($kriteria as $row_kriteria) {
            // Tentukan opsi berdasarkan atribut kriteria
            $options = "";
            if ($row_kriteria["atribut"] == "benefit") {
                $options = "
                    <option value='4'>Sangat Memuaskan - 4</option>
                    <option value='3'>Memuaskan  - 3</option>
                    <option value='2'>Cukup Memuaskan - 2</option>
                    <option value='1'>Sangat Tidak Memuaskan - 1</option>
                ";
            } elseif ($row_kriteria["atribut"] == "cost") {
                $options = "
                    <option value='1'>Sangat Memuaskan - 1</option>
                    <option value='2'>Memuaskan - 2</option>
                    <option value='3'>Cukup Memuaskan - 3</option>
                    <option value='4'>Sangat Tidak Memuaskan - 4</option>
                ";
            }

    ?>
            <div class="mb-3">
                <label for="nilai<?php echo $row_kriteria["id_kriteria"]; ?>" class="form-label"><?php echo $row_kriteria["nama_kriteria"]; ?>:</label>
                <select name="nilai<?php echo $row_kriteria["id_kriteria"]; ?>" class="form-select">
                    <?php echo $options; ?>
                </select>
                <input type="hidden" name="id_kriteria[]" value="<?php echo $row_kriteria["id_kriteria"]; ?>">
            </div>
    <?php
        }
    } else {
        echo "<p>Tidak ada kriteria.</p>";
    }
    ?>
    <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
</form>