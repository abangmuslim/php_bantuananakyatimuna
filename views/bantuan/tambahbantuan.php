<section class="content">
  <div class="card text-sm">
    <div class="card-header bg-gradient-primary">
      <h2 class="card-title text-white">Tambah Data Bantuan</h2>
    </div>

    <div class="card-body">
      <div class="card card-warning">
        <form action="db/dbbantuan.php?proses=tambah" method="POST">
          <div class="card-body-sm ml-2">

            <!-- Nama Bantuan -->
            <div class="form-group">
              <label for="nama_bantuan">Nama Bantuan</label>
              <input type="text" 
                     class="form-control" 
                     id="nama_bantuan" 
                     name="nama_bantuan"
                     placeholder="Contoh: Bantuan Sembako, Dana Pendidikan" 
                     required>
            </div>

            <!-- Nominal Bantuan -->
            <div class="form-group">
              <label for="nominal">Nominal Bantuan (Rp)</label>
              <input type="number" 
                     step="0.01" 
                     class="form-control text-right" 
                     id="nominal" 
                     name="nominal"
                     placeholder="Masukkan nominal bantuan" 
                     min="0" 
                     required>
              <small class="text-muted">Masukkan jumlah nominal bantuan dalam rupiah.</small>
            </div>

            <!-- Keterangan Bantuan -->
            <div class="form-group">
              <label for="keterangan">Keterangan / Deskripsi Bantuan</label>
              <textarea class="form-control" 
                        id="keterangan" 
                        name="keterangan" 
                        rows="3"
                        placeholder="Tuliskan deskripsi singkat tentang bantuan ini..."></textarea>
            </div>

            <!-- Tombol Simpan dan Reset -->
            <div class="form-group mt-4 text-right">
              <button type="reset" class="btn btn-warning mr-2">
                <i class="fas fa-undo"></i> Reset
              </button>
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
            </div>

          </div>
        </form>
      </div>
    </div>

    <div class="card-footer text-sm text-muted">
      Formulir pengisian data bantuan baru.
    </div>
  </div>
</section>
