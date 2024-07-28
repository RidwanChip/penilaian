<?php
include 'Models/Kriteria.php';

use Models\Kriteria;

$db = new Kriteria();
?>
<h2 class="pt-3">Data kriteria</h2>
<?php
msg_query();
Auth();
?>
<a href="../penilaian/page.php?q=kriteriaInput"><button class="btn btn-success"><i class="bi bi-plus-lg"></i> Data Kriteria</button></a>
<div class='table-responsive pt-2'>
    <table id="myTable" class="table table-striped table-bordered" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Kriteria</th>
                <th>Atribut</th>
                <th>Bobot</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $kriteria) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $kriteria['id_kriteria'] ?></td>
                    <td><?php echo $kriteria['nama_kriteria'] ?></td>
                    <td><?php echo $kriteria['atribut'] ?></td>
                    <td><?php echo $kriteria['bobot'] ?></td>
                    <td>
                        <a href="../penilaian/page.php?q=kriteriaEdit&id_kriteria=<?php echo $kriteria['id_kriteria']; ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                        <a href="../penilaian/page.php?q=kriteriaAct&id_kriteria=<?php echo $kriteria['id_kriteria']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>