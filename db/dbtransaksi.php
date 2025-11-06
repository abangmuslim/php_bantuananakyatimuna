<?php
$proses = isset($_GET['proses']) ? $_GET['proses'] : '';
include "../koneksi.php";
session_start();

// Folder target foto transaksi
$targetDir = "../views/transaksi/fototransaksi/";
if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

// Fungsi ambil nominal dari tabel bantuan
function getNominal($koneksi, $id_bantuan) {
    $q = mysqli_query($koneksi, "SELECT nominal FROM bantuan WHERE id_bantuan='$id_bantuan'");
    $r = mysqli_fetch_assoc($q);
    return $r ? $r['nominal'] : 0;
}

// Tambah transaksi
if ($proses == 'tambah') {

    $id_penerima = intval($_POST['id_penerima']);
    $id_bantuan  = intval($_POST['id_bantuan']);
    $id_admin    = intval($_POST['id_admin']);
    $tanggal_pembayaran = htmlspecialchars($_POST['tanggal_pembayaran']);

    // Ambil nominal dari bantuan
    $nominal = getNominal($koneksi, $id_bantuan);

    // Upload foto bukti
    $foto = '';
    if (!empty($_FILES['foto']['name'])) {
        $file_name = basename($_FILES['foto']['name']);
        $file_tmp  = $_FILES['foto']['tmp_name'];
        $file_size = $_FILES['foto']['size'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg','jpeg','png'];

        if (in_array($file_ext, $allowed_ext) && $file_size <= 2*1024*1024) {
            $foto = date('YmdHis') . '_' . $file_name;
            move_uploaded_file($file_tmp, $targetDir . $foto);
        }
    }

    mysqli_query($koneksi, "INSERT INTO transaksi SET 
        id_penerima='$id_penerima',
        id_bantuan='$id_bantuan',
        id_admin='$id_admin',
        tanggal_pembayaran='$tanggal_pembayaran',
        nominal='$nominal',
        foto='$foto'
    ");

} elseif ($proses == 'edit') {

    $id_transaksi = intval($_POST['id_transaksi']);
    $id_penerima  = intval($_POST['id_penerima']);
    $id_bantuan   = intval($_POST['id_bantuan']);
    $id_admin     = intval($_POST['id_admin']);
    $tanggal_pembayaran = htmlspecialchars($_POST['tanggal_pembayaran']);

    // Ambil nominal dari bantuan
    $nominal = getNominal($koneksi, $id_bantuan);

    // Ambil data lama
    $sqlShow = mysqli_query($koneksi, "SELECT foto FROM transaksi WHERE id_transaksi='$id_transaksi'");
    $result  = mysqli_fetch_assoc($sqlShow);
    $foto    = $result['foto']; // default foto lama

    if (!empty($_FILES['foto']['name'])) {
        $file_name = basename($_FILES['foto']['name']);
        $file_tmp  = $_FILES['foto']['tmp_name'];
        $file_size = $_FILES['foto']['size'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg','jpeg','png'];

        if (in_array($file_ext, $allowed_ext) && $file_size <= 2*1024*1024) {
            // hapus foto lama jika ada
            if (!empty($foto) && file_exists($targetDir . $foto)) unlink($targetDir . $foto);

            $foto = date('YmdHis') . '_' . $file_name;
            move_uploaded_file($file_tmp, $targetDir . $foto);
        }
    }

    mysqli_query($koneksi, "UPDATE transaksi SET
        id_penerima='$id_penerima',
        id_bantuan='$id_bantuan',
        id_admin='$id_admin',
        tanggal_pembayaran='$tanggal_pembayaran',
        nominal='$nominal',
        foto='$foto'
        WHERE id_transaksi='$id_transaksi'
    ");

} elseif ($proses == 'hapus') {

    $id_transaksi = intval($_GET['id_transaksi']);

    // hapus foto lama
    $sqlShow = mysqli_query($koneksi, "SELECT foto FROM transaksi WHERE id_transaksi='$id_transaksi'");
    $result  = mysqli_fetch_assoc($sqlShow);

    if (!empty($result['foto']) && file_exists($targetDir . $result['foto'])) {
        unlink($targetDir . $result['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'");
}

// redirect ke halaman daftar transaksi
header("location:../index.php?halaman=daftartransaksi");
exit();
?>
