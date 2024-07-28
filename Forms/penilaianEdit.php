<?php
include 'Models/Penilaian.php';

use Models\Penilaian;

$db = new Penilaian();
$row = $db->edit_data($_GET['id_penilaian']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penilaian</title>
    <h3 class="pt-3">Edit Data Penilaian</h3>
</head>

<body>
    <form action="../penilaian/page.php?q=penilaianAct&aksi=update" method="POST">
        <?php
        foreach ($row as $penilaian) {
            // Determine the options based on the attribute of the criterion
            $nilai_options = "";
            if ($penilaian['atribut'] == 'benefit') {
                $nilai_options .= '
                    <option value="4" ' . ($penilaian['nilai'] == 4 ? 'selected' : '') . '>Sangat Memuaskan - 4</option>
                    <option value="3" ' . ($penilaian['nilai'] == 3 ? 'selected' : '') . '>Memuaskan - 3</option>
                    <option value="2" ' . ($penilaian['nilai'] == 2 ? 'selected' : '') . '>Cukup Memuaskan - 2</option>
                    <option value="1" ' . ($penilaian['nilai'] == 1 ? 'selected' : '') . '>Sangat Tidak Memuaskan - 1</option>';
            } elseif ($penilaian['atribut'] == 'cost') {
                $nilai_options .= '
                    <option value="1" ' . ($penilaian['nilai'] == 1 ? 'selected' : '') . '>Sangat Memuaskan - 1</option>
                    <option value="2" ' . ($penilaian['nilai'] == 2 ? 'selected' : '') . '>Memuaskan - 2</option>
                    <option value="3" ' . ($penilaian['nilai'] == 3 ? 'selected' : '') . '>Cukup Memuaskan - 3</option>
                    <option value="4" ' . ($penilaian['nilai'] == 4 ? 'selected' : '') . '>Sangat Tidak Memuaskan - 4</option>';
            }
        ?>
            <input type="hidden" id="id_penilaian" name="id_penilaian" value="<?php echo $penilaian['id_penilaian'] ?>" hidden>
            <div>
                <label for="" class="form-label">Nama Karyawan :</label>
                <input type="text" class="form-control" name="" value="<?php echo $penilaian['nama_karyawan'] ?>" disabled>
            </div>
            <!-- <label for="id_karyawan">Nama Karyawan : <?php echo $penilaian['nama_karyawan'] ?></label> <br> -->
            <div>
                <label for="" class="form-label">Nilai <?php echo $penilaian['nama_kriteria'] ?> :</label>
            </div>
            <!-- <label for="nilai">Nilai <?php echo $penilaian['nama_kriteria'] ?> :</label> -->
            <div>
                <select class="form-select" id="nilai" name="nilai">
                    <?php echo $nilai_options; ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="tanggal_penilaian">Tanggal Penilaian :</label>
                <input class="form-control" type="date" id="tanggal_penilaian" name="tanggal_penilaian" value="<?php echo $penilaian['tanggal_penilaian'] ?>" disabled> <br>
            </div>
        <?php
        }
        ?>
        <button class="btn btn-primary" type="submit" name="submit">Simpan</button>
    </form>
</body>

</html>