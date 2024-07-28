<h2 class="mt-3">Tambah Kriteria</h2>
<form action="../penilaian/page.php?q=kriteriaAct&aksi=tambah" method="post">
    <div class="mb-3">
        <label for="nama_kriteria" class="form-label">Nama Kriteria:</label>
        <input type="text" class="form-control" name="nama_kriteria" required>
    </div>
    <div class="mb-3">
        <label for="atribut">Atribut:</label>
        <select class="form-control" name="atribut" required>
            <option value="benefit">Benefit</option>
            <option value="cost">Cost</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="bobot" class="form-label">Bobot :</label>
        <input type="number" step="0.01" class="form-control" name="bobot" required>
    </div>
    <button type="submit" name="tambah" class="btn btn-primary">Tambah Kriteria</button>
</form>
<?php
