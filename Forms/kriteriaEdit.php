<?php
include 'Models/Kriteria.php';

use Models\Kriteria;

$db = new Kriteria();
//var_dump($db->edit_data($_GET['id_kriteria']));
$row = $db->edit_data($_GET['id_kriteria']);
?>
<h2 class="mt-3">Edit kriteria</h2>
<form action="../penilaian/page.php?q=kriteriaAct&aksi=update" method="post">
    <?php
    foreach ($row as $kriteria) {
    ?>
        <input type="hidden" name="id_kriteria" value="<?php echo $kriteria['id_kriteria'] ?>">
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label">Nama kriteria:</label>
            <input type="text" class="form-control" name="nama_kriteria" value="<?php echo $kriteria['nama_kriteria']; ?>">
        </div>
        <div class="mb-3">
            <label for='atribut'>Atribut:</label>
            <select name='atribut' class='form-select'>
                <option value='benefit' <?php echo ($kriteria['atribut'] == 'benefit') ? 'selected' : ''; ?>>Benefit</option>
                <option value='cost' <?php echo ($kriteria['atribut'] == 'cost') ? 'selected' : ''; ?>>Cost</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="bobot" class="form-label">Bobot</label>
            <input type="number" step="0.01" class="form-control" name="bobot" value="<?php echo $kriteria['bobot']; ?>">
        </div>
    <?php
    }
    ?>
    <button type="submit" name="edit" class="btn btn-primary">Update kriteria</button>
</form>