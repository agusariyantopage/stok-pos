<?php
session_start();

if (empty($_SESSION['backend_user_id'])) {
  header("location:login.php");
}

include "koneksi.php";
include "controller.php";
include "function.php";
$status_proses = $_SESSION['status_proses'];
date_default_timezone_set('Asia/Singapore');
// // Include PhpSpreadsheet library autoloader 
// require_once 'vendor/autoload.php'; 
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
// $Reader = new Xlsx();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= $title; ?></title>
  <link rel="shortcut icon" type="image/png" href="<?= $APP_ICO; ?>" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= $APP_LOGO; ?>" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="<?= $APP_LOGO; ?>" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $APP_TITLE . " " . $APP_VERSION; ?></span>
      </a>


      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?= $_SESSION['backend_user_nama']; ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


            <li class="nav-item">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard

                </p>
              </a>
            </li>


            <?php
            // $_SESSION['backend_level'] = 1;
            if ($_SESSION['backend_level'] == 1) {
              include "menu_admin.php";
            } else if ($_SESSION['backend_level'] == 2) {
              include "menu_petugas.php";
            }
            ?>
            <li class="nav-item">
              <a href="aksi/user.php?aksi=logout" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>

        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <?php
    //$konten ="konten/home.php";
    include $konten; ?>

    <footer class="main-footer">
      <strong>Copyright &copy; 2021 <a href="https://backtoskull.wordpress.com">Agus Ariyanto</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0 (Last Update : <?= $APP_VERSION_LAST_UPDATE; ?>)
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->




  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>

  <!-- Plugin Sweet Alert -->
  <script src="dist/js/sweetalert2.all.min.js"></script>
  <!--<script src="dist/js/script-alert.js"></script> -->

  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- numberformatter -->
  <script src="dist/js/easy-number-separator.js"></script>

  <?php //include "script-alert.php" 
  ?>

  <!-- Page specific script -->
  <script>
    $(function() {
      $("#exportonly").DataTable({
        "responsive": false,
        "lengthChange": false,
        "paging": false,
        "order": false,
        "searching": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#exportonly_wrapper .col-md-6:eq(0)');
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "order": [
          [0, 'desc']
        ],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      $('#finditem').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#noorder').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#noorder-nopaging').DataTable({
        "paging": false,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
      $('#polos').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      }).buttons().container().appendTo('#polos_wrapper .col-md-6:eq(0)');



      // Modul Sweet Alert
      var statusProses = '<?= $status_proses; ?>';
      //alert('statusProses');
      if (statusProses === 'LOGIN-SUKSES') {
        Swal.fire({
          //position: 'top-end',
          icon: 'success',
          title: 'Login Berhasil',
          showConfirmButton: false,
          timer: 2000

        })
      }
      if (statusProses === 'LOGIN-GAGAL') {
        Swal.fire({
          //position: 'top-end',
          icon: 'error',
          title: 'Login Gagal, Username / Password Salah',
          showConfirmButton: false,
          timer: 2000

        })
      }
      if (statusProses === 'SUKSES UPDATE VERSI') {
        Swal.fire({
          //position: 'top-end',
          icon: 'success',
          title: 'Berhasil Mengupdate Versi Aplikasi',
          showConfirmButton: false,
          timer: 4000

        })
      }
      if (statusProses === 'SUKSES') {
        Swal.fire({
          //position: 'top-end',
          icon: 'success',
          title: 'Berhasil Memproses Transaksi',
          showConfirmButton: false,
          timer: 2000

        })
      }
      if (statusProses === 'GAGAL') {
        Swal.fire({
          //position: 'top-end',
          icon: 'error',
          title: 'Gagal Memproses Transaksi',
          showConfirmButton: false,
          timer: 2000

        })
      }
      if (statusProses === 'SUKSES SIMPAN JUAL') {
        Swal.fire({
          //position: 'top-end',
          icon: 'success',
          title: 'Berhasil Memproses Transaksi',
          showConfirmButton: false,
          timer: 2000

        })
      }
      if (statusProses === 'SUKSES SIMPAN BELI') {
        Swal.fire({
          //position: 'top-end',
          icon: 'success',
          title: 'Berhasil Memproses Transaksi',
          showConfirmButton: false,
          timer: 2000

        })
      }

      $(document).on('click', '.hapuspenjualan', function() {
        //$('.infopenjualan').click(function(){

        var idjual = $(this).data('id');
        //alert(idjual);

        // AJAX request
        $.ajax({
          url: 'server-side/hapusjual.php',
          type: 'post',
          data: {
            idjual: idjual
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);

            // Display Modal
            //$('#empModal').modal('show'); 
          }
        });
      });

      $(document).on('click', '.infopenjualan', function() {
        //$('.infopenjualan').click(function(){

        var idjual = $(this).data('id');
        //alert(idjual);

        // AJAX request
        $.ajax({
          url: 'server-side/infojual.php',
          type: 'post',
          data: {
            idjual: idjual
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);

            // Display Modal
            //$('#empModal').modal('show'); 
          }
        });
      });

      $(document).on('click', '.infopembelian', function() {
        //$('.infopembelian').click(function(){

        var idbeli = $(this).data('id');
        //alert(idbeli);

        // AJAX request
        $.ajax({
          url: 'server-side/infobeli.php',
          type: 'post',
          data: {
            idbeli: idbeli
          },
          success: function(response) {
            // Add response in Modal body
            $('.modal-body').html(response);
          }
        });
      });

      $(document).on('click', '.simpanan_input_bayar', function() {
        var id_simpanan_detail = $(this).data('id');
        var id_simpanan = $(this).data('id2');

        //alert(id_simpanan_detail);

        // AJAX request
        $.ajax({
          url: 'server-side/simpanan_input_bayar.php',
          type: 'post',
          data: {
            id_simpanan_detail: id_simpanan_detail,
            id_simpanan: id_simpanan
          },
          success: function(response) {
            // Add response in Modal body
            $('.isi-input-bayar').html(response);
          }
        });
      });


      // Konten Interaktif Tambah Input Pembayaran Pinjaman
      $(document).on('click', '.pinjaman_input_bayar', function() {

        var id_pinjaman = $(this).data('id');

        $.ajax({
          url: 'server-side/pinjaman_input_bayar.php',
          type: 'post',
          data: {
            id_pinjaman: id_pinjaman
          },
          success: function(response) {
            $('.isi-input-bayar-pinjaman').html(response);
          }
        });
      });

      // Konten Interaktif Untuk Ubah Anggota
      $(document).on('click', '.ubah_anggota', function() {

        var id_anggota = $(this).data('id');

        $.ajax({
          url: 'server-side/anggota_ubah.php',
          type: 'post',
          data: {
            id_anggota: id_anggota
          },
          success: function(response) {
            $('.isi-anggota-ubah').html(response);
          }
        });
      });

      // Konten Interaktif Untuk Cek Data Terkait Sebelum Hapus Anggota
      $(document).on('click', '.konfirmasi_hapus_anggota', function() {

        var id_anggota = $(this).data('id');
        //alert(id_anggota);
        $.ajax({
          url: 'server-side/anggota_konfirmasi_hapus.php',
          type: 'post',
          data: {
            id_anggota: id_anggota
          },
          success: function(response) {
            $('.isi-anggota-konfirmasi-hapus').html(response);
          }
        });
      });

      $(document).on('click', '.cek-konsinyasi', function() {
        //$('.infopembelian').click(function(){

        var id_produk = $(this).data('id');
        var aksi = 'ubah-status-konsinyasi';
        var konsinyasi = 0;
        //alert(id_produk);
        if (document.getElementById('cek-konsinyasi' + id_produk).checked) {
          konsinyasi = 1;
        } else {
          konsinyasi = 0;
        }

        // AJAX request
        $.ajax({
          url: 'aksi/produk.php',
          type: 'post',
          data: {
            id_produk: id_produk,
            konsinyasi: konsinyasi,
            aksi: aksi
          },
          success: function(response) {
            // Add response in Modal body
            //$('.modal-body').html(response);
            //alert(id_produk+'-'+aksi+'-'+konsinyasi);


          }
        });
      });

      //$('.select2').select2();
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      });
      $('#id_anggota2').select2({
        dropdownParent: $('#simpanJualModal'),
        theme: 'bootstrap4'
      });
      $('#id_akun').select2({
        dropdownParent: $('#simpanJualModal'),
        theme: 'bootstrap4'
      });
      $('#id_akun').select2({
        dropdownParent: $('#laporanKasToko'),
        theme: 'bootstrap4'
      });
      $('#id_anggota1').select2({
        dropdownParent: $('#simpanJualModalKas'),
        theme: 'bootstrap4'
      });
      $('#id_anggota').select2({
        dropdownParent: $('#simpanJualModalCicil'),
        theme: 'bootstrap4'
      });
      $('#id_pemasok').select2({
        dropdownParent: $('#simpanJualModal'),
        theme: 'bootstrap4'
      });
      $('#id_debet').select2({
        dropdownParent: $('#tambahJurnalModal'),
        theme: 'bootstrap4'
      });
      $('#id_kredit').select2({
        dropdownParent: $('#tambahJurnalModal'),
        theme: 'bootstrap4'
      });
      easyNumberSeparator({
        selector: '.number-separator',
        separator: ',',
        resultInput: '#result_input',
      });

    });
  </script>

  <script>
    // Modul Kembalian Pembayaran Kas
    function hitung_kembalian(evt) {
      var total = document.getElementById("grandtotal").value;
      var bayar = document.getElementById("bayar").value;
      var kembali = bayar - total;
      document.getElementById("kembali").innerHTML = "Rp. " + kembali;
    }

    document.getElementById('bayar').addEventListener("mouseup", function(evt) {
      hitung_kembalian();
    }, false);
    document.getElementById('bayar').addEventListener("keyup", function(evt) {
      hitung_kembalian();
    }, false);
  </script>

  <script>
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    <?php
    $query = "SELECT * FROM jual";
    $sql = mysqli_query($koneksi, $query);
    $total = mysqli_num_rows($sql);

    $query1 = "SELECT * FROM jual WHERE status_bayar = 'Belum Lunas'";
    $sql1 = mysqli_query($koneksi, $query1);
    $total_belum_lunas = mysqli_num_rows($sql1);

    $total_lunas = $total - $total_belum_lunas;
    ?>
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
      labels: [
        'Lunas',
        'Belum Lunas'
      ],
      datasets: [{
        data: [<?= $total_lunas ?>, <?= $total_belum_lunas ?>],
        backgroundColor: ['#00ff1a', '#FF0000'],
      }]
    }
    var pieOptions = {
      maintainAspectRatio: false,
      responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })
  </script>

  <script>
    //-------------
    //- BAR CHART -
    //-------------
    <?php
    // mengambil data dari tabel user
    $query = "SELECT CONCAT(YEAR(tanggal_transaksi),'-',MONTHNAME(tanggal_transaksi)) AS tahun_bulan, SUM(total) AS jumlah_bulanan FROM jual GROUP BY YEAR(tanggal_transaksi),MONTH(tanggal_transaksi)";
    $sql = mysqli_query($koneksi, $query);
    // untuk pengulangan baris
    while ($row = mysqli_fetch_array($sql)) {
      $tahun_bulan = $row['tahun_bulan'];
      $sql_biaya = "SELECT COALESCE(SUM(debet-kredit),0) AS total_pengeluaran FROM akun_mutasi INNER JOIN akun ON akun.id_akun=akun_mutasi.id_akun INNER JOIN akun_jurnal ON akun_jurnal.id_akun_jurnal=akun_mutasi.id_akun_jurnal WHERE akun.akun LIKE '%Biaya%' AND CONCAT(YEAR(tanggal_transaksi),'-',MONTHNAME(tanggal_transaksi))='$tahun_bulan'";
      $query_biaya = mysqli_query($koneksi, $sql_biaya);
      $biaya = mysqli_fetch_array($query_biaya);

      $nama_tahun[] = $row['tahun_bulan'];
      $jumlah_tahun[] = $row['jumlah_bulanan'];
      $biaya_tahun[] = $biaya['total_pengeluaran'];
      // $biaya_tahun[] = 1000;
    } ?>
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = {
      labels: <?php echo json_encode($nama_tahun); ?>,
      datasets: [{
          label: 'Omset',
          backgroundColor: 'rgba(0,255,0,0.9)',
          borderColor: 'rgba(0,255,0,0.8)',
          pointRadius: false,
          pointColor: '#B3005E',
          pointStrokeColor: 'rgba(0,255,0,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(0,255,0,1)',
          data: <?php echo json_encode($jumlah_tahun); ?>
        },
        {
          label: 'Biaya',
          backgroundColor: 'rgba(255,0,0,0.9)',
          borderColor: 'rgba(255,0,0,0.8)',
          pointRadius: false,
          pointColor: '#B3005E',
          pointStrokeColor: 'rgba(255,0,0,1)',
          pointHighlightFill: '#fff',
          pointHighlightStroke: 'rgba(255,0,0,1)',
          data: <?php echo json_encode($biaya_tahun); ?>
        }
      ]
    }

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
  </script>

  <script>
    //-------------
    //- AREA CHART -
    //-------------
    <?php
    // mengambil data dari tabel user
    $query = "SELECT CONCAT(YEAR(tanggal_transaksi),'-',MONTHNAME(tanggal_transaksi)) AS tahun_bulan, SUM(total) AS jumlah_bulanan FROM jual GROUP BY YEAR(tanggal_transaksi),MONTH(tanggal_transaksi)";
    $sql = mysqli_query($koneksi, $query);
    // untuk pengulangan baris
    while ($row = mysqli_fetch_array($sql)) {
      $tahun_bulan = $row['tahun_bulan'];
      $sql_biaya = "SELECT COALESCE(SUM(debet-kredit),0) AS total_pengeluaran FROM akun_mutasi INNER JOIN akun ON akun.id_akun=akun_mutasi.id_akun INNER JOIN akun_jurnal ON akun_jurnal.id_akun_jurnal=akun_mutasi.id_akun_jurnal WHERE akun.akun LIKE '%Biaya%' AND CONCAT(YEAR(tanggal_transaksi),'-',MONTHNAME(tanggal_transaksi))='$tahun_bulan'";
      $query_biaya = mysqli_query($koneksi, $sql_biaya);
      $biaya = mysqli_fetch_array($query_biaya);

      $nama_tahun_area[] = $row['tahun_bulan'];
      $jumlah_tahun_area[] = $row['jumlah_bulanan'];
      $biaya_tahun_area[] = $biaya['total_pengeluaran'];
      // $biaya_tahun_area[] = 1000;
    } ?>
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    var areaChartData = {
      labels: <?php echo json_encode($nama_tahun_area); ?>,
      datasets: [{
          label: 'Omset',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data: <?php echo json_encode($jumlah_tahun_area); ?>
        },
        {
          label: 'Biaya',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data: <?php echo json_encode($biaya_tahun_area); ?>
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //---------------------

    
  </script>



  <?php
  $_SESSION['status_proses'] = '';
  ?>

</body>

</html>