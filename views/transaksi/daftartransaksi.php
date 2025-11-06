<?php
// views/transaksi/daftartransaksi.php
// Halaman daftar transaksi
$query = mysqli_query($koneksi, "
    SELECT t.*, p.nama_penerima, b.nama_bantuan, b.nominal, a.nama_admin 
    FROM transaksi t 
    JOIN penerima p ON t.id_penerima=p.id_penerima 
    JOIN bantuan b ON t.id_bantuan=b.id_bantuan 
    JOIN admin a ON t.id_admin=a.id_admin 
    ORDER BY t.id_transaksi DESC
");
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Daftar Transaksi</h3>
    <div class="card-tools">
      <a href="index.php?halaman=tambahtransaksi" class="btn btn-light btn-sm float-right">+ Tambah Transaksi</a>
    </div>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-striped table-sm">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Penerima</th>
          <th>Nama Bantuan</th>
          <th>Nominal</th>
          <th>Admin</th>
          <th>Tanggal Pembayaran</th>
          <th>Foto Bukti</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) :
          $fotoPath = "views/transaksi/fototransaksi/" . $row['foto'];
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nama_penerima']); ?></td>
            <td><?= htmlspecialchars($row['nama_bantuan']); ?></td>
            <td><?= number_format($row['nominal'], 0, ",", "."); ?></td>
            <td><?= htmlspecialchars($row['nama_admin']); ?></td>
            <td><?= htmlspecialchars($row['tanggal_pembayaran']); ?></td>
            <td>
              <?php if (!empty($row['foto']) && file_exists($fotoPath)) : ?>
                <img src="<?= htmlspecialchars($fotoPath); ?>" alt="bukti" style="width:60px; height:auto; object-fit:cover;">
              <?php else : ?>
                <span class="text-muted">(Belum ada)</span>
              <?php endif; ?>
            </td>
            <td>
              <a href="index.php?halaman=edittransaksi&id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="db/dbtransaksi.php?proses=hapus&id_transaksi=<?= $row['id_transaksi']; ?>"
                onclick="return confirm('Yakin ingin hapus data ini?');"
                class="btn btn-danger btn-sm">Hapus</a>
              <a href="index.php?halaman=detailtransaksi&id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-info btn-sm">Lihat Detail</a>
              <a href="views/transaksi/cetakstruk.php?id_transaksi=<?= $row['id_transaksi']; ?>" target="_blank" class="btn btn-info btn-sm">Cetak</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>