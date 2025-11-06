<?php
$proses = isset($_GET['proses']) ? $_GET['proses'] : '';
include "../koneksi.php";
session_start();

$targetDir = "../views/admin/fotoadmin/";
if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

if ($proses == 'tambah') {

    $nama_admin = $_POST['nama_admin'];
    $username   = $_POST['username'];
    $password   = md5($_POST['password']); // model lama

    $foto       = $_FILES['foto']['name'];
    $tmp_foto   = $_FILES['foto']['tmp_name'];

    if (!empty($foto)) {
        $namafilebaru = date('YmdHis') . '_' . $foto;
        move_uploaded_file($tmp_foto, $targetDir . $namafilebaru);
    } else {
        $namafilebaru = '';
    }

    mysqli_query($koneksi, "INSERT INTO admin SET 
        nama_admin='$nama_admin',
        username='$username',
        password='$password',
        foto='$namafilebaru'
    ");

} elseif ($proses == 'edit') {

    $id_admin   = $_POST['id_admin'];
    $nama_admin = $_POST['nama_admin'];
    $username   = $_POST['username'];
    $password   = $_POST['password']; // opsional

    $foto       = $_FILES['foto']['name'];
    $tmp_foto   = $_FILES['foto']['tmp_name'];

    // Ambil data lama
    $sqlShow   = mysqli_query($koneksi, "SELECT * FROM admin WHERE id_admin='$id_admin'");
    $result    = mysqli_fetch_assoc($sqlShow);

    if (!empty($foto)) {
        if (!empty($result['foto']) && file_exists($targetDir . $result['foto'])) {
            unlink($targetDir . $result['foto']);
        }
        $namafilebaru = date('YmdHis') . '_' . $foto;
        move_uploaded_file($tmp_foto, $targetDir . $namafilebaru);
    } else {
        $namafilebaru = $result['foto'];
    }

    if (!empty($password)) {
        $password = md5($password);
        mysqli_query($koneksi, "UPDATE admin SET 
            nama_admin='$nama_admin',
            username='$username',
            password='$password',
            foto='$namafilebaru'
            WHERE id_admin='$id_admin'
        ");
    } else {
        mysqli_query($koneksi, "UPDATE admin SET 
            nama_admin='$nama_admin',
            username='$username',
            foto='$namafilebaru'
            WHERE id_admin='$id_admin'
        ");
    }

} elseif ($proses == 'hapus') {

    $id_admin = $_GET['id_admin'];

    $sqlShow   = mysqli_query($koneksi, "SELECT foto FROM admin WHERE id_admin='$id_admin'");
    $result    = mysqli_fetch_assoc($sqlShow);

    if (!empty($result['foto']) && file_exists($targetDir . $result['foto'])) {
        unlink($targetDir . $result['foto']);
    }

    mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin='$id_admin'");
}

// redirect ke halaman admin
header("location:../index.php?halaman=admin");
?>
