<?php
include "../koneksi.php";
session_start();

$proses = $_GET['proses'] ?? '';

// Folder target foto transaksi
$targetDir = "../views/transaksi/fototransaksi/";
if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

// Ambil nominal dari tabel bantuan
function getNominal($koneksi, $id_bantuan) {
    $id_bantuan = intval($id_bantuan);
    $q = mysqli_query($koneksi, "SELECT nominal FROM bantuan WHERE id_bantuan='$id_bantuan' LIMIT 1");
    $r = mysqli_fetch_assoc($q);
    return $r ? intval($r['nominal']) : 0;
}

// Upload foto
function uploadFoto($fileInput, $targetDir) {
    if (empty($fileInput['name'])) return '';

    $file_name = basename($fileInput['name']);
    $file_tmp  = $fileInput['tmp_name'];
    $file_size = $fileInput['size'];
    $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg','jpeg','png'];

    if (!in_array($file_ext, $allowed_ext)) return '';
    if ($file_size > 2*1024*1024) return '';

    $new_name = date('YmdHis') . '_' . preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $file_name);
    if (move_uploaded_file($file_tmp, $targetDir . $new_name)) return $new_name;

    return '';
}

// ======================= TAMBAH =======================
if ($proses == 'tambah') {

    $id_penerima = intval($_POST['id_penerima'] ?? 0);
    $id_bantuan  = intval($_POST['id_bantuan'] ?? 0);
    $id_admin    = intval($_POST['id_admin'] ?? 0);
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'] ?? '';

    if (!$id_penerima || !$id_bantuan || !$id_admin || !$tanggal_pembayaran) {
        die("Error: Data tidak lengkap!");
    }

    $nominal = getNominal($koneksi, $id_bantuan);
    $foto = uploadFoto($_FILES['foto'] ?? [], $targetDir);

    $stmt = mysqli_prepare($koneksi, "INSERT INTO transaksi (id_penerima, id_bantuan, id_admin, tanggal_pembayaran, nominal, foto) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iiisis", $id_penerima, $id_bantuan, $id_admin, $tanggal_pembayaran, $nominal, $foto);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

// ======================= EDIT =======================
elseif ($proses == 'edit') {

    $id_transaksi = intval($_POST['id_transaksi'] ?? 0);
    $id_penerima  = intval($_POST['id_penerima'] ?? 0);
    $id_bantuan   = intval($_POST['id_bantuan'] ?? 0);
    $id_admin     = intval($_POST['id_admin'] ?? 0);
    $tanggal_pembayaran = $_POST['tanggal_pembayaran'] ?? '';

    if (!$id_transaksi || !$id_penerima || !$id_bantuan || !$id_admin || !$tanggal_pembayaran) {
        die("Error: Data tidak lengkap!");
    }

    $nominal = getNominal($koneksi, $id_bantuan);

    // Ambil foto lama
    $sqlShow = mysqli_query($koneksi, "SELECT foto FROM transaksi WHERE id_transaksi='$id_transaksi' LIMIT 1");
    $result = mysqli_fetch_assoc($sqlShow);
    $foto = $result['foto'] ?? '';

    // Upload foto baru
    $newFoto = uploadFoto($_FILES['foto'] ?? [], $targetDir);
    if ($newFoto) {
        if (!empty($foto) && file_exists($targetDir . $foto)) unlink($targetDir . $foto);
        $foto = $newFoto;
    }

    $stmt = mysqli_prepare($koneksi, "UPDATE transaksi SET id_penerima=?, id_bantuan=?, id_admin=?, tanggal_pembayaran=?, nominal=?, foto=? WHERE id_transaksi=?");
    mysqli_stmt_bind_param($stmt, "iiisisi", $id_penerima, $id_bantuan, $id_admin, $tanggal_pembayaran, $nominal, $foto, $id_transaksi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}

// ======================= HAPUS =======================
elseif ($proses == 'hapus') {

    $id_transaksi = intval($_GET['id_transaksi'] ?? 0);
    if (!$id_transaksi) die("Error: ID tidak ditemukan!");

    // Hapus foto lama
    $sqlShow = mysqli_query($koneksi, "SELECT foto FROM transaksi WHERE id_transaksi='$id_transaksi' LIMIT 1");
    $result = mysqli_fetch_assoc($sqlShow);
    if (!empty($result['foto']) && file_exists($targetDir . $result['foto'])) {
        unlink($targetDir . $result['foto']);
    }

    $stmt = mysqli_prepare($koneksi, "DELETE FROM transaksi WHERE id_transaksi=?");
    mysqli_stmt_bind_param($stmt, "i", $id_transaksi);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

} else {
    die("Proses tidak dikenali!");
}

// Redirect ke daftar transaksi
header("Location: ../index.php?halaman=daftartransaksi");
exit();
?>
