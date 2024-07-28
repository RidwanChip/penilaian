<?php
include 'Models/Penilaian.php';
include 'Models/Karyawan.php';

use Models\Penilaian;
use Models\Karyawan;

$db1 = new Karyawan();
$db = new Penilaian();
?>
<h2 class='mt-3'>Data Penilaian Karyawan</h2>
<?php
msg_query();
Auth();
?>
<div class='table-responsive pt-2'>
    <table id="myTable1" class="table table-striped table-bordered" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama Karyawan</th>
                <th>Bagian</th>
                <th>Penilaian bulan ini</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db1->tampil_data() as $karyawan) {
                $sudah_dinilai = $db->cek_penilaian_bulanan($karyawan['id_karyawan']);
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $karyawan['id_karyawan'] ?></td>
                    <td><?php echo $karyawan['nama_karyawan'] ?></td>
                    <td><?php echo $karyawan['bagian'] ?></td>
                    <td class="<?php echo $sudah_dinilai ? 'table-success' : 'table-danger'; ?>">
                        <?php echo $sudah_dinilai ? '<b>Sudah Dinilai</b>' : '<b>Belum Dinilai</b>'; ?>
                    </td>
                    <td>
                        <a href="../penilaian/page.php?q=penilaianInput&id_karyawan=<?php echo $karyawan['id_karyawan']; ?>&nama_karyawan=<?php echo $karyawan['nama_karyawan']; ?>"><button class="btn btn-sm btn-success">Tambah Penilaian</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<hr>
<h2 class='mt-3'>Detail Penilaian</h2>
<div class='table-responsive pt-3'>
    <table id="myTable" class="table table-striped table-bordered" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th hidden>ID Penilaian</th>
                <th>ID Karyawan</th>
                <th>Nama Karyawan</th>
                <th>Kriteria</th>
                <th>Nilai</th>
                <th>Tanggal</th>
                <th>Kelola</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($db->tampil_data() as $penilaian) {
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td hidden><?php echo $penilaian['id_penilaian'] ?></td>
                    <td><?php echo $penilaian['id_karyawan'] ?></td>
                    <td><?php echo $penilaian['nama_karyawan'] ?></td>
                    <td><?php echo $penilaian['nama_kriteria'] ?></td>
                    <td><?php echo $penilaian['nilai'] ?></td>
                    <td><?php echo $penilaian['tanggal_penilaian'] ?></td>
                    <td>
                        <a href="../penilaian/page.php?q=penilaianEdit&id_penilaian=<?php echo $penilaian['id_penilaian']; ?>"><button class="btn btn-sm btn-info">Edit</button></a>
                        <a href="../penilaian/page.php?q=penilaianAct&id_karyawan=<?php echo $penilaian['id_karyawan']; ?>&tanggal_penilaian=<?php echo $penilaian['tanggal_penilaian']; ?>&aksi=hapus_data" onclick="return confirm('Apakah Anda yakin ingin menghapus semua kriteria penilaian data terpilih?')"><button class="btn btn-sm btn-danger">Delete</button></a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>