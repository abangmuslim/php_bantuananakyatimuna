<?php
// Asumsi: $koneksi tersedia dari layout/index.
// Ambil data berdasar id_penerima di query string
$id = intval($_GET['id_penerima']);
$sql = mysqli_query($koneksi, "SELECT * FROM penerima WHERE id_penerima='$id'");
$data = mysqli_fetch_assoc($sql);
?>

<!-- Main content -->
<section class="content">

  <div class="card card-success">
    <div class="card-header bg-gradient-success">
      <h5 class="card-title text-white"><i class="fas fa-edit"></i> Edit Data Penerima</h5>
    </div>

    <form action="db/dbpenerima.php?proses=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_penerima" value="<?= htmlspecialchars($data['id_penerima']); ?>">
      <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($data['foto']); ?>">

      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NISP <small class="text-danger">*</small></label>
              <input type="text" name="nisp" class="form-control" value="<?= htmlspecialchars($data['nisp']); ?>" required>
            </div>
            <div class="form-group">
              <label>Nama Penerima <small class="text-danger">*</small></label>
              <input type="text" name="nama_penerima" class="form-control" value="<?= htmlspecialchars($data['nama_penerima']); ?>" required>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($data['kelas']); ?>">
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" value="<?= htmlspecialchars($data['tanggal_lahir']); ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" maxlength="100" value="<?= htmlspecialchars($data['alamat']); ?>">
            </div>
            <div class="form-group">
              <label>Status</label>
              <input type="text" name="status" class="form-control" value="<?= htmlspecialchars($data['status']); ?>">
            </div>
            <div class="form-group">
              <label>Pendapatan Orang Tua (angka)</label>
              <input type="number" name="pendapatan_orang_tua" class="form-control" min="0" step="1" value="<?= htmlspecialchars($data['pendapatan_orang_tua']); ?>">
            </div>
            <div class="form-group">
              <label>Foto</label><br>
              <?php if (!empty($data['foto'])): ?>
                <img src="views/penerima/fotopenerima/<?= htmlspecialchars($data['foto']); ?>" width="80" height="80" class="mb-2" style="object-fit:cover;border-radius:8px;"><br>
              <?php endif; ?>
              <input type="file" name="foto" class="form-control-file" accept="image/*">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-right">
        <a href="index.php?halaman=penerima" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Update</button>
      </div>
    </form>
  </div>

</section>
