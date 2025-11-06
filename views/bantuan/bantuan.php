<?php
// Ambil data bantuan dari tabel
$query = mysqli_query($koneksi, "SELECT * FROM bantuan ORDER BY id_bantuan DESC");
$no = 1;
?>

<section class="content">
  <div class="card text-sm">
    <div class="card-header bg-gradient-primary">
      <h2 class="card-title text-white">Data Bantuan</h2>
      <a href="index.php?halaman=tambahbantuan" class="btn btn-light btn-sm float-right">
        <i class="fas fa-plus"></i> Tambah Bantuan
      </a>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="bg-dark text-white">
            <tr>
              <th width="5%">No</th>
              <th>Nama Bantuan</th>
              <th class="text-right">Nominal (Rp)</th>
              <th>Keterangan</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($data['nama_bantuan']); ?></td>
                <td class="text-right">Rp <?= number_format($data['nominal'], 2, ',', '.'); ?></td>
                <td><?= nl2br(htmlspecialchars($data['keterangan'] ?? '-')); ?></td>
                <td>
                  <!-- Tombol Edit -->
                  <a href="index.php?halaman=editbantuan&id_bantuan=<?= $data['id_bantuan']; ?>"
                    class="btn btn-warning btn-sm" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>

                  <!-- Tombol Hapus -->
                  <a href="db/dbbantuan.php?proses=hapus&id_bantuan=<?= $data['id_bantuan']; ?>"
                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                    class="btn btn-danger btn-sm" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-footer text-muted text-sm">
      Data bantuan yang tersedia dalam sistem.
    </div>
  </div>
</section>
