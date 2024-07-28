<?php
include 'Models/Widget.php';

use Models\Widget;

$db = new Widget();

// Memanggil metode untuk menampilkan jumlah karyawan
$jumlah_karyawan = $db->tampil_data();
$jumlah_kriteria = $db->tampil_data_kriteria();
$penilaianBulanan = $db->jumlahKaryawanBelumDinilaiBulanIni();

Auth();
?>
<h1 class="pt-3">Halaman Utama</h1>
<?php
msg_query();
?>
<div class="row gap-3 m-1">
    <div class="card text-bg-primary mb-3" style="max-width: 15rem;">
        <div class="card-body">
            <h5 class="card-title">Data Karyawan</h5>
            <p class="card-text">Jumlah Karyawan :<br> <?php echo $jumlah_karyawan ?> Karyawan</p>
            <br>
            <a href="../penilaian/page.php?q=karyawanView" class="text-light">Selengkapnya</a>
        </div>
    </div>
    <div class="card text-bg-info mb-3" style="max-width: 15rem;">
        <div class="card-body text-light">
            <h5 class="card-title">Data Penilaian</h5>
            <p class="card-text">Karyawan Yang Belum Dinilai Bulan Ini :<br> <?php echo $penilaianBulanan ?> Karyawan</p>
            <a href="../penilaian/page.php?q=penilaianView" class="text-light">Selengkapnya</a>
        </div>
    </div>
    <div class="card text-bg-secondary mb-3" style="max-width: 15rem;">
        <div class="card-body">
            <h5 class="card-title">Data Kriteria</h5>
            <p class="card-text">Jumlah Kriteria :<br> <?php echo $jumlah_kriteria ?> Kriteria</p>
            <br>
            <a href="../penilaian/page.php?q=kriteriaView" class="text-light">Selengkapnya</a>
        </div>
    </div>
</div>
<h3>Sistem Pendukung Keputusan Penilaian Karyawan Kontrak</h3>
<p>Aplikasi ini dibangun dengan menggunakan metode Simple Additive Weighting sebagai metode pengambilan Keputusan yang bertujuan untuk mempermudah penilaian karyawan kontrak.</p>