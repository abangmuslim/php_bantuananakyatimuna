<?php
include "../koneksi.php";

$proses = $_GET['proses'];

// ===================== TAMBAH =====================
if ($proses == 'tambah') {

  $nisp = htmlspecialchars($_POST['nisp']);
  $nama_penerima = htmlspecialchars($_POST['nama_penerima']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = htmlspecialchars($_POST['alamat']);
  $status = htmlspecialchars($_POST['status']);
  $pendapatan = intval($_POST['pendapatan_orang_tua']);

  // === Upload Foto ===
  $foto = "";
  if (!empty($_FILES['foto']['name'])) {
    $folder = "../views/penerima/fotopenerima/"; // 🔹 Folder penyimpanan baru
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    $namaFile = time() . "_" . basename($_FILES['foto']['name']);
    $target = $folder . $namaFile;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
      $foto = $namaFile;
    }
  }

  $sql = "INSERT INTO penerima (nisp, nama_penerima, kelas, tanggal_lahir, alamat, status, pendapatan_orang_tua, foto)
          VALUES ('$nisp', '$nama_penerima', '$kelas', '$tanggal_lahir', '$alamat', '$status', '$pendapatan', '$foto')";
  mysqli_query($koneksi, $sql);

  header("location:../index.php?halaman=penerima&pesan=berhasil_tambah");
}

// ===================== EDIT =====================
elseif ($proses == 'edit') {

  $id_penerima = intval($_POST['id_penerima']);
  $nisp = htmlspecialchars($_POST['nisp']);
  $nama_penerima = htmlspecialchars($_POST['nama_penerima']);
  $kelas = htmlspecialchars($_POST['kelas']);
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = htmlspecialchars($_POST['alamat']);
  $status = htmlspecialchars($_POST['status']);
  $pendapatan = intval($_POST['pendapatan_orang_tua']);

  $cek = mysqli_query($koneksi, "SELECT foto FROM penerima WHERE id_penerima='$id_penerima'");
  $dataLama = mysqli_fetch_assoc($cek);
  $fotoLama = $dataLama['foto'];

  $foto = $fotoLama;
  if (!empty($_FILES['foto']['name'])) {
    $folder = "../views/penerima/fotopenerima/"; // 🔹 folder baru
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    $namaFile = time() . "_" . basename($_FILES['foto']['name']);
    $target = $folder . $namaFile;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
      // Hapus foto lama jika ada
      if (!empty($fotoLama) && file_exists($folder . $fotoLama)) {
        unlink($folder . $fotoLama);
      }
      $foto = $namaFile;
    }
  }

  $sql = "UPDATE penerima SET 
            nisp='$nisp',
            nama_penerima='$nama_penerima',
            kelas='$kelas',
            tanggal_lahir='$tanggal_lahir',
            alamat='$alamat',
            status='$status',
            pendapatan_orang_tua='$pendapatan',
            foto='$foto'
          WHERE id_penerima='$id_penerima'";

  mysqli_query($koneksi, $sql);
  header("location:../index.php?halaman=penerima&pesan=berhasil_edit");
}

// ===================== HAPUS =====================
elseif ($proses == 'hapus') {
  $id_penerima = intval($_GET['id_penerima']);

  $folder = "../views/penerima/fotopenerima/";
  $cek = mysqli_query($koneksi, "SELECT foto FROM penerima WHERE id_penerima='$id_penerima'");
  $data = mysqli_fetch_assoc($cek);

  if (!empty($data['foto']) && file_exists($folder . $data['foto'])) {
    unlink($folder . $data['foto']);
  }

  mysqli_query($koneksi, "DELETE FROM penerima WHERE id_penerima='$id_penerima'");
  header("location:../index.php?halaman=penerima&pesan=berhasil_hapus");
}
?>
