<?php
// Ambil data admin & bantuan
$admin = mysqli_query($koneksi, "SELECT id_admin, nama_admin FROM admin ORDER BY nama_admin ASC");
$bantuan = mysqli_query($koneksi, "SELECT id_bantuan, nama_bantuan, nominal FROM bantuan ORDER BY nama_bantuan ASC");
?>

<section class="content">
  <div class="container-fluid">
    <div class="card card-primary shadow-sm">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Tambah Transaksi Bantuan</h3>
      </div>

      <form action="db/dbtransaksi.php?proses=tambah" method="POST" enctype="multipart/form-data" id="formTransaksi">
        <div class="card-body">

          <!-- === PILIH PENERIMA (DataTables) === -->
          <div class="form-group">
            <label><strong>Pilih Penerima</strong> <small class="text-danger">*</small></label>
            <table id="tablePenerima" class="table table-bordered table-striped text-sm">
              <thead class="bg-light">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Pendapatan Orang Tua</th>
                  <th class="text-center">Pilih</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                // 🔹 Hanya tampilkan penerima dengan pendapatan di bawah 1 juta
                $q = mysqli_query($koneksi, "
                  SELECT id_penerima, nama_penerima, kelas, pendapatan_orang_tua 
                  FROM penerima 
                  WHERE pendapatan_orang_tua < 1000000 
                  ORDER BY nama_penerima ASC 
                  LIMIT 500
                ");
                while ($row = mysqli_fetch_assoc($q)):
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= htmlspecialchars($row['nama_penerima']); ?></td>
                  <td><?= htmlspecialchars($row['kelas']); ?></td>
                  <td><?= number_format($row['pendapatan_orang_tua'], 0, ',', '.'); ?></td>
                  <td class="text-center">
                    <input type="radio" name="id_penerima" value="<?= intval($row['id_penerima']); ?>" required>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>

          <hr>

          <!-- === PILIH BANTUAN & ADMIN === -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><strong>Nama Bantuan</strong> <small class="text-danger">*</small></label>
                <select class="form-control" name="id_bantuan" id="id_bantuan" required>
                  <option value="">-- Pilih Bantuan --</option>
                  <?php while ($row = mysqli_fetch_assoc($bantuan)): ?>
                    <option value="<?= intval($row['id_bantuan']); ?>" data-nominal="<?= $row['nominal']; ?>">
                      <?= htmlspecialchars($row['nama_bantuan']); ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label><strong>Tanggal Pembayaran</strong> <small class="text-danger">*</small></label>
                <input type="date" class="form-control" name="tanggal_pembayaran" value="<?= date('Y-m-d'); ?>" required>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label><strong>Nama Admin</strong> <small class="text-danger">*</small></label>
                <select class="form-control" name="id_admin" required>
                  <option value="">-- Pilih Admin --</option>
                  <?php while ($row = mysqli_fetch_assoc($admin)): ?>
                    <option value="<?= intval($row['id_admin']); ?>"><?= htmlspecialchars($row['nama_admin']); ?></option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label><strong>Nominal Bantuan</strong></label>
                <input type="text" class="form-control" id="nominal" name="nominal" readonly placeholder="Nominal otomatis dari bantuan">
              </div>
            </div>
          </div>

          <!-- === UPLOAD FOTO === -->
          <div class="form-group">
            <label><strong>Upload Bukti Pembayaran</strong></label>
            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
            <small class="form-text text-muted">Format JPG/PNG, maksimal 2MB.</small>
          </div>

        </div>

        <div class="card-footer text-right">
          <button type="reset" class="btn btn-warning" id="btnReset">Reset</button>
          <button type="submit" class="btn btn-success">Simpan</button>
          <a href="index.php?halaman=daftartransaksi" class="btn btn-secondary">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- ====== CSS/JS ====== -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  // === PREVIEW FOTO ===
  document.getElementById('foto').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (evt) {
      const imgPreview = document.getElementById('previewFoto');
      if (imgPreview) imgPreview.remove();
      const img = document.createElement('img');
      img.src = evt.target.result;
      img.id = 'previewFoto';
      img.style.maxWidth = '150px';
      img.style.display = 'block';
      img.style.marginTop = '10px';
      e.target.insertAdjacentElement('afterend', img);
    };
    reader.readAsDataURL(file);
  });

  // === UPDATE NOMINAL OTOMATIS SAAT BANTUAN DIPILIH ===
  document.addEventListener('DOMContentLoaded', function () {
    const bantuanSelect = document.getElementById('id_bantuan');
    const nominalInput = document.getElementById('nominal');

    bantuanSelect.addEventListener('change', function () {
      const selectedOption = this.options[this.selectedIndex];
      if (selectedOption && selectedOption.dataset.nominal) {
        const nominal = parseFloat(selectedOption.dataset.nominal);
        nominalInput.value = nominal.toLocaleString('id-ID');
      } else {
        nominalInput.value = '';
      }
    });
  });
</script>

