<?php
include "koneksi.php";

// Pastikan parameter id_bantuan ada
if (!isset($_GET['id_bantuan'])) {
    die("ID bantuan tidak ditemukan.");
}

$id_bantuan = intval($_GET['id_bantuan']); // hindari SQL injection dasar
$query = mysqli_query($koneksi, "SELECT * FROM bantuan WHERE id_bantuan='$id_bantuan'");

// Validasi data ditemukan
if (!$query || mysqli_num_rows($query) == 0) {
    die("Data bantuan tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);
?>

<section class="content">
  <div class="card text-sm">
    <div class="card-header bg-gradient-warning">
      <h2 class="card-title text-white">Edit Data Bantuan</h2>
    </div>

    <div class="card-body">
      <div class="card card-warning">
        <form action="db/dbbantuan.php?proses=edit" method="POST">
          <div class="card-body-sm ml-2">
            <input type="hidden" name="id_bantuan" value="<?= htmlspecialchars($data['id_bantuan']); ?>">

            <!-- Nama Bantuan -->
            <div class="form-group">
              <label for="nama_bantuan">Nama Bantuan</label>
              <input type="text" class="form-control" id="nama_bantuan" name="nama_bantuan"
                value="<?= htmlspecialchars($data['nama_bantuan']); ?>" required>
            </div>

            <!-- Nominal Bantuan -->
            <div class="form-group">
              <label for="nominal">Nominal Bantuan (Rp)</label>
              <input type="number" step="0.01" class="form-control text-right" id="nominal" name="nominal"
                value="<?= htmlspecialchars($data['nominal']); ?>" required>
            </div>

            <!-- Keterangan Bantuan -->
            <div class="form-group">
              <label for="keterangan">Keterangan / Deskripsi Bantuan</label>
              <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                placeholder="Tuliskan deskripsi singkat..."><?= htmlspecialchars($data['keterangan']); ?></textarea>
            </div>

            <!-- Tombol -->
            <div class="form-group mt-4 text-right">
              <a href="index.php?halaman=bantuan" class="btn btn-secondary mr-2">
                <i class="fas fa-arrow-left"></i> Kembali
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>

    <div class="card-footer text-sm text-muted">
      Formulir pengubahan data bantuan.
    </div>
  </div>
</section>
