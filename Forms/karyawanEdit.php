<?php
include 'Models/Karyawan.php';

use Models\Karyawan;

$db = new Karyawan();
//var_dump($db->edit_data($_GET['id_karyawan']));
$row = $db->edit_data($_GET['id_karyawan']);
?>
<h2 class="mt-3">Edit Karyawan</h2>
<form action="../penilaian/page.php?q=karyawanAct&aksi=update" method="post">
    <?php
    foreach ($row as $karyawan) {
    ?>
        <input type="hidden" name="id_karyawan" value="<?php echo $karyawan['id_karyawan'] ?>">
        <div class="mb-3">
            <label for="nama_karyawan" class="form-label">Nama Karyawan:</label>
            <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $karyawan['nama_karyawan']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="bagian" class="form-label">Bagian:</label>
            <input type="text" class="form-control" name="bagian" value="<?php echo $karyawan['bagian']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat:</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $karyawan['alamat']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">Kontak:</label>
            <input type="text" class="form-control" name="no_hp" value="<?php echo $karyawan['no_hp']; ?>" required>
        </div>
    <?php
    }
    ?>
    <button type="submit" name="edit" class="btn btn-primary">Update Karyawan</button>
</form>