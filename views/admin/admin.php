<?php
// admin.php - menampilkan semua admin
// Diasumsikan koneksi.php sudah di-include dari layout
?>

<div class="card card-solid">
  <div class="col">
    <a href="index.php?halaman=tambahadmin" class="btn btn-primary float-right btn-sm mt-3">
      <i class="fas fa-user-plus"></i> Tambah Admin
    </a>
  </div>

  <div class="card-body pb-0">
    <div class="row">

      <?php
      // Ambil semua data admin dari database
      $query = mysqli_query($koneksi, "SELECT * FROM admin ORDER BY id_admin DESC");
      while ($data = mysqli_fetch_assoc($query)) {
          // Foto admin, jika kosong gunakan placeholder
          $foto = !empty($data['foto']) ? "views/admin/fotoadmin/" . $data['foto'] : "dist/img/default-user.png";
      ?>
        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
          <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">Administrator</div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-7">
                  <h2 class="lead"><b><?= htmlspecialchars($data['nama_admin']) ?></b></h2>
                  <p class="text-muted text-sm">
                    <b>Username: </b><?= htmlspecialchars($data['username']) ?>
                  </p>
                  <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small">
                      <span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span>
                      ID: <?= $data['id_admin'] ?>
                    </li>
                  </ul>
                </div>
                <div class="col-5 text-center">
                  <img src="<?= $foto ?>" alt="user-avatar" class="img-circle img-fluid" style="width:100px;height:100px;object-fit:cover;">
                </div>
              </div>
            </div>
            <div class="card-footer">
              <div class="text-right">
                <!-- Tombol edit -->
                <a href="index.php?halaman=editadmin&id_admin=<?= $data['id_admin'] ?>" class="btn btn-sm bg-teal">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <!-- Tombol hapus -->
                <a href="db/dbadmin.php?proses=hapus&id_admin=<?= $data['id_admin'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Yakin ingin menghapus admin <?= htmlspecialchars($data['nama_admin']); ?>?');">
                  <i class="fas fa-trash"></i> Hapus
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>

  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
      </ul>
    </nav>
  </div>
</div>
