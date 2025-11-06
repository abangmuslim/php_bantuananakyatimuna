<?php
$proses = $_GET['proses'];
include "../koneksi.php";

session_start();

// === TAMBAH DATA BANTUAN ===
if ($proses == 'tambah') {
    $nama_bantuan = $_POST['nama_bantuan'];
    $nominal      = $_POST['nominal'];
    $keterangan   = $_POST['keterangan'];

    mysqli_query($koneksi, "INSERT INTO bantuan 
        (nama_bantuan, nominal, keterangan)
        VALUES ('$nama_bantuan', '$nominal', '$keterangan')");


// === EDIT DATA BANTUAN ===
} elseif ($proses == 'edit') {
    $id_bantuan   = $_POST['id_bantuan'];
    $nama_bantuan = $_POST['nama_bantuan'];
    $nominal      = $_POST['nominal'];
    $keterangan   = $_POST['keterangan'];

    mysqli_query($koneksi, "UPDATE bantuan SET 
        nama_bantuan='$nama_bantuan',
        nominal='$nominal',
        keterangan='$keterangan'
        WHERE id_bantuan='$id_bantuan'");


// === HAPUS DATA BANTUAN ===
} elseif ($proses == 'hapus') {
    $id_bantuan = $_GET['id_bantuan'];
    mysqli_query($koneksi, "DELETE FROM bantuan WHERE id_bantuan='$id_bantuan'");
}

header("location:../index.php?halaman=bantuan");
?>
