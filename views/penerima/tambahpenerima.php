<!-- Main content -->
<section class="content">

  <div class="card card-warning">
    <div class="card-header bg-gradient-warning">
      <h5 class="card-title text-white"><i class="fas fa-plus-circle"></i> Tambah Data Penerima</h5>
    </div>

    <form action="db/dbpenerima.php?proses=tambah" method="POST" enctype="multipart/form-data">
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>NISP <small class="text-danger">*</small></label>
              <input type="text" name="nisp" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Nama Penerima <small class="text-danger">*</small></label>
              <input type="text" name="nama_penerima" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <input type="text" name="kelas" class="form-control">
            </div>
            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" maxlength="100">
            </div>
            <div class="form-group">
              <label>Status</label>
              <input type="text" name="status" class="form-control" placeholder="Contoh: Aktif / Nonaktif">
            </div>
            <div class="form-group">
              <label>Pendapatan Orang Tua (angka)</label>
              <input type="number" name="pendapatan_orang_tua" class="form-control" min="0" step="1" placeholder="Nominal dalam satuan rupiah (tanpa titik)">
            </div>
            <div class="form-group">
              <label>Foto</label>
              <input type="file" name="foto" class="form-control-file" accept="image/*">
            </div>
          </div>
        </div>

      </div>

      <div class="card-footer text-right">
        <a href="index.php?halaman=penerima" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <button type="reset" class="btn btn-warning btn-sm"><i class="fa fa-retweet"></i> Reset</button>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </form>
  </div>

</section>
