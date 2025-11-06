<?php
// views/transaksi/tambahtransaksi.php
// Ambil data bantuan, penerima, admin untuk dropdown
$bantuan = mysqli_query($koneksi, "SELECT id_bantuan, nama_bantuan, nominal FROM bantuan ORDER BY nama_bantuan ASC");
$penerima = mysqli_query($koneksi, "SELECT id_penerima, nama_penerima FROM penerima ORDER BY nama_penerima ASC");
$admin = mysqli_query($koneksi, "SELECT id_admin, nama_admin FROM admin ORDER BY nama_admin ASC");
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Tambah Transaksi</h3>
  </div>

  <div class="card-body">
    <form action="db/dbtransaksi.php?proses=tambah" method="POST" enctype="multipart/form-data">
      <div class="row">
        <!-- Kolom kiri -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="id_penerima">Nama Penerima <small class="text-danger">*</small></label>
            <select class="form-control" name="id_penerima" id="id_penerima" required>
              <option value="">-- Pilih Penerima --</option>
              <?php while ($row = mysqli_fetch_assoc($penerima)) : ?>
                <option value="<?= intval($row['id_penerima']); ?>"><?= htmlspecialchars($row['nama_penerima']); ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="id_bantuan">Nama Bantuan <small class="text-danger">*</small></label>
            <select class="form-control" name="id_bantuan" id="id_bantuan" required>
              <option value="">-- Pilih Bantuan --</option>
              <?php
              // Reset pointer untuk penggunaan di JS
              mysqli_data_seek($bantuan, 0);
              $bantuan_arr = [];
              while ($row = mysqli_fetch_assoc($bantuan)) {
                $bantuan_arr[$row['id_bantuan']] = $row['nominal'];
                echo '<option value="' . intval($row['id_bantuan']) . '" data-nominal="' . $row['nominal'] . '">' . htmlspecialchars($row['nama_bantuan']) . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="tanggal_pembayaran">Tanggal Pembayaran <small class="text-danger">*</small></label>
            <input type="date" class="form-control" name="tanggal_pembayaran" id="tanggal_pembayaran"
              value="<?= date('Y-m-d'); ?>" required>
          </div>

        </div>

        <!-- Kolom kanan -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="id_admin">Nama Admin <small class="text-danger">*</small></label>
            <select class="form-control" name="id_admin" id="id_admin" required>
              <option value="">-- Pilih Admin --</option>
              <?php while ($row = mysqli_fetch_assoc($admin)) : ?>
                <option value="<?= intval($row['id_admin']); ?>"><?= htmlspecialchars($row['nama_admin']); ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="nominal">Nominal Bantuan</label>
            <input type="text" class="form-control" name="nominal" id="nominal" readonly placeholder="Nominal otomatis dari bantuan">
          </div>

          <div class="form-group">
            <label for="foto">Upload Bukti Pembayaran</label>
            <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
            <small class="form-text text-muted">Format: JPG, PNG. Maks 2MB.</small>
          </div>
        </div>
      </div>

      <div class="form-group mt-3 text-right">
        <button type="submit" name="action" value="add" class="btn btn-primary">Simpan</button>
        <a href="index.php?halaman=daftartransaksi" class="btn btn-secondary">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
  // Preview foto sebelum upload
  document.getElementById('foto').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(evt) {
      const img = document.createElement('img');
      img.src = evt.target.result;
      img.style.maxWidth = '150px';
      img.style.marginTop = '10px';
      const prev = document.querySelector('#previewFoto');
      if (prev) prev.remove();
      img.id = 'previewFoto';
      e.target.insertAdjacentElement('afterend', img);
    };
    reader.readAsDataURL(file);
  });

  // Update nominal otomatis saat bantuan dipilih
  const bantuanSelect = document.getElementById('id_bantuan');
  const nominalInput = document.getElementById('nominal');

  bantuanSelect.addEventListener('change', function() {
    const selectedOption = bantuanSelect.options[bantuanSelect.selectedIndex];
    const nominal = selectedOption.getAttribute('data-nominal') || '';
    nominalInput.value = nominal ? parseInt(nominal).toLocaleString('id-ID') : '';
  });
</script>