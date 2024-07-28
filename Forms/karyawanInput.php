<h2 class="mt-3">Tambah Karyawan</h2>
<form action="../penilaian/page.php?q=karyawanAct&aksi=tambah" method="post">
    <div class="mb-3">
        <label for="nama_karyawan" class="form-label">Nama Karyawan:</label>
        <input type="text" class="form-control" name="nama_karyawan" required>
    </div>
    <div class="mb-3">
        <label for="bagian" class="form-label">Bagian:</label>
        <input type="text" class="form-control" name="bagian" required>
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat:</label>
        <input type="text" class="form-control" name="alamat" required>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">Kontak:</label>
        <input type="text" class="form-control" name="no_hp" required>
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah Karyawan</button>
</form>
<?php
