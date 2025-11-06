<?php
$idadmin = intval($_GET['idadmin']);
$sql = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$idadmin'");
$data = mysqli_fetch_assoc($sql);
?>

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Admin</h3>
    </div>


    <form action="db/dbadmin.php?proses=edit" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id_admin" value="<?= $data['id_admin'] ?>">

        <div class="card-body">
            <div class="form-group">
                <label for="nama_admin">Nama Admin</label>
                <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?= htmlspecialchars($data['nama_admin']) ?>" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($data['username']) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password <small class="text-muted">(kosongkan jika tidak ingin diubah)</small></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
            </div>

            <div class="form-group">
                <label for="foto">Foto Admin</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto" accept="image/*">
                        <label class="custom-file-label" for="foto">Pilih file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>

                <?php if (!empty($data['foto'])): ?>
                    <img src="views/admin/fotoadmin/<?= htmlspecialchars($data['foto']) ?>" id="previewFoto" style="max-width:150px;margin-top:10px;">
                <?php endif; ?>
                <small class="form-text text-muted">Format JPG/PNG, max 2MB</small>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="index.php?halaman=admin" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(evt) {
            let img = document.getElementById('previewFoto');
            if (!img) {
                img = document.createElement('img');
                img.id = 'previewFoto';
                img.style.maxWidth = '150px';
                img.style.marginTop = '10px';
                e.target.insertAdjacentElement('afterend', img);
            }
            img.src = evt.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>