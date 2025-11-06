<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'pages/header.php'; ?>

  <!-- ======== DataTables CSS ======== -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">

<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <?php include 'pages/navbar.php'; ?>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php include 'pages/sidebar.php'; ?>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <?php
      if (isset($_GET['halaman'])) {
        switch ($_GET['halaman']) {
          case "admin": include("views/admin/admin.php"); break;
          case "tambahadmin": include("views/admin/tambahadmin.php"); break;
          case "editadmin": include("views/admin/editadmin.php"); break;

          case "penerima": include("views/penerima/penerima.php"); break;
          case "tambahpenerima": include("views/penerima/tambahpenerima.php"); break;
          case "editpenerima": include("views/penerima/editpenerima.php"); break;

          case "bantuan": include("views/bantuan/bantuan.php"); break;
          case "tambahbantuan": include("views/bantuan/tambahbantuan.php"); break;
          case "editbantuan": include("views/bantuan/editbantuan.php"); break;

          case "daftartransaksi": include("views/transaksi/daftartransaksi.php"); break;
          case "tambahtransaksi": include("views/transaksi/tambahtransaksi.php"); break;
          case "edittransaksi": include("views/transaksi/edittransaksi.php"); break;
          case "tampiltransaksi": include("views/pembayaran/editpembayaran.php"); break;

          case "dashboard": include("views/dashboard.php"); break;
          case "home": include("views/dashboard.php"); break;

          default: include("views/notfound.php"); break;
        }
      } else {
        include("views/dashboard.php");
      }
      ?>
    </section>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>

  <!-- Footer -->
  <footer class="main-footer">
    <?php include 'pages/footer.php'; ?>
  </footer>
</div>

<!-- ========== REQUIRED SCRIPTS ========== -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>

<!-- ======== DataTables JS ======== -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- ======== GLOBAL DATATABLE INIT ======== -->
<script>
$(document).ready(function () {
  <?php if (!isset($disableGlobalDataTable)) : ?>
  $('table.table').each(function() {
    // Hindari re-init jika sudah aktif
    if (!$.fn.DataTable.isDataTable(this)) {
      $(this).DataTable({
        scrollX: true,
        responsive: true,
        paging: true,
        lengthChange: true,
        lengthMenu: [[5, 10, 25, 50, 100], [5, 10, 25, 50, 100]],
        pageLength: 10,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        dom: "<'dataTables-top'Bfl>tip",
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis'],
        language: {
          lengthMenu: "Tampilkan _MENU_ entri",
          zeroRecords: "Tidak ada data ditemukan",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
          infoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
          search: "Cari:",
          paginate: {
            previous: "Sebelumnya",
            next: "Berikutnya"
          }
        }
      });
    }
  });
  <?php endif; ?>
});
</script>

</body>
</html>
