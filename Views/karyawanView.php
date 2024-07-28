<?php
include 'Models/Karyawan.php';

use Models\Karyawan;

$db = new Karyawan();
?>
<h2 class="pt-3">Data Karyawan</h2>
<?php
msg_query();
Auth();
?>
<a href="../penilaian/page.php?q=karyawanInput"><button class="btn btn-success"><i class="bi bi-person-fill-add"></i> Tambah Karyawan</button></a>
<div class='table-responsive pt-2'>
    <table id="myTable" class="table table-striped table-bordered" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Bagian</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $karyawan) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $karyawan['id_karyawan'] ?></td>
                    <td><?php echo $karyawan['nama_karyawan'] ?></td>
                    <td><?php echo $karyawan['bagian'] ?></td>
                    <td><?php echo $karyawan['alamat'] ?></td>
                    <td><?php echo $karyawan['no_hp'] ?></td>
                    <td>
                        <a href="../penilaian/page.php?q=karyawanEdit&id_karyawan=<?php echo $karyawan['id_karyawan']; ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                        <a href="../penilaian/page.php?q=karyawanAct&id_karyawan=<?php echo $karyawan['id_karyawan']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>