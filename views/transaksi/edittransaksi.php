<?php
// views/transaksi/edittransaksi.php
// Asumsi: $koneksi tersedia dari layout/index
$id = intval($_GET['id_transaksi']);
$sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id'");
$data = mysqli_fetch_assoc($sql);

// Ambil data dropdown
$bantuan = mysqli_query($koneksi, "SELECT id_bantuan, nama_bantuan, nominal FROM bantuan ORDER BY nama_bantuan ASC");
$penerima = mysqli_query($koneksi, "SELECT id_penerima, nama_penerima FROM penerima ORDER BY nama_penerima ASC");
$admin = mysqli_query($koneksi, "SELECT id_admin, nama_admin FROM admin ORDER BY nama_admin ASC");
?>

<section class="content">

  <div class="card card-info">
    <div class="card-header bg-gradient-info">
      <h5 class="card-title text-white"><i class="fas fa-edit"></i> Edit Transaksi</h5>
    </div>

    <form action="db/dbtransaksi.php?proses=edit" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id_transaksi" value="<?= intval($data['id_transaksi']); ?>">
      <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($data['foto']); ?>">

      <div class="card-body">
        <div class="row">

          <!-- Kolom kiri -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Nama Penerima <small class="text-danger">*</small></label>
              <select name="id_penerima" class="form-control" required>
                <option value="">-- Pilih Penerima --</option>
                <?php while($row = mysqli_fetch_assoc($penerima)): ?>
                  <option value="<?= intval($row['id_penerima']); ?>" <?= $row['id_penerima']==$data['id_penerima'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row['nama_penerima']); ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Nama Bantuan <small class="text-danger">*</small></label>
              <select name="id_bantuan" id="id_bantuan" class="form-control" required>
                <option value="">-- Pilih Bantuan --</option>
                <?php 
                mysqli_data_seek($bantuan, 0); // reset pointer
                while($row = mysqli_fetch_assoc($bantuan)): ?>
                  <option value="<?= intval($row['id_bantuan']); ?>" data-nominal="<?= $row['nominal']; ?>" <?= $row['id_bantuan']==$data['id_bantuan'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row['nama_bantuan']); ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Nama Admin <small class="text-danger">*</small></label>
              <select name="id_admin" class="form-control" required>
                <option value="">-- Pilih Admin --</option>
                <?php while($row = mysqli_fetch_assoc($admin)): ?>
                  <option value="<?= intval($row['id_admin']); ?>" <?= $row['id_admin']==$data['id_admin'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row['nama_admin']); ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Tanggal Pembayaran <small class="text-danger">*</small></label>
              <input type="date" name="tanggal_pembayaran" class="form-control" value="<?= htmlspecialchars($data['tanggal_pembayaran']); ?>" required>
            </div>
          </div>

          <!-- Kolom kanan -->
          <div class="col-md-6">
            <div class="form-group">
              <label>Nominal</label>
              <input type="text" id="nominal" class="form-control" value="<?= number_format($data['nominal'],0,',','.'); ?>" readonly>
              <input type="hidden" name="nominal" id="nominal_hidden" value="<?= $data['nominal']; ?>">
            </div>

            <div class="form-group">
              <label>Bukti Pembayaran</label><br>
              <?php if(!empty($data['foto'])): ?>
                <div id="previewFoto">
                  <img src="views/transaksi/fototransaksi/<?= htmlspecialchars($data['foto']); ?>" width="120" height="120" class="mb-2" style="object-fit:cover;border-radius:8px;"><br>
                </div>
              <?php else: ?>
                <span class="text-muted">(Belum ada)</span><br>
              <?php endif; ?>
              <input type="file" name="foto" class="form-control-file" accept="image/*">
              <small class="text-muted">Kosongkan jika tidak ingin mengubah foto. Max 2MB, JPG/PNG.</small>
            </div>
          </div>

        </div>
      </div>

      <div class="card-footer text-right">
        <a href="index.php?halaman=daftartransaksi" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="submit" name="action" value="edit" class="btn btn-info btn-sm"><i class="fa fa-save"></i> Update</button>
      </div>
    </form>
  </div>

</section>

<script>
  // Preview foto baru sebelum upload
  document.querySelector('input[name="foto"]').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(!file) return;
    const reader = new FileReader();
    reader.onload = function(evt){
      let prev = document.getElementById('previewFoto');
      if(prev) prev.remove();
      const img = document.createElement('img');
      img.src = evt.target.result;
      img.style.maxWidth='150px';
      img.style.marginTop='10px';
      img.id='previewFoto';
      e.target.insertAdjacentElement('afterend', img);
    };
    reader.readAsDataURL(file);
  });

  // Update nominal otomatis saat pilih bantuan
  const selectBantuan = document.getElementById('id_bantuan');
  const nominalField = document.getElementById('nominal');
  const nominalHidden = document.getElementById('nominal_hidden');
  selectBantuan.addEventListener('change', function(){
    const selectedOption = selectBantuan.options[selectBantuan.selectedIndex];
    const nominal = selectedOption.getAttribute('data-nominal') || 0;
    nominalField.value = parseInt(nominal).toLocaleString('id-ID');
    nominalHidden.value = nominal;
  });
</script>
