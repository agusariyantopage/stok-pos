<?php
// Include PhpSpreadsheet library autoloader 
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$Reader = new Xlsx();

if (isset($_POST['upload'])) { // IF 1
    $pesan = '';
    $namafile = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $namafile;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    mysqli_query($koneksi, "START TRANSACTION");

    if ($imageFileType != "xlsx") {
        $msg = "<span class='badge badge-danger'>Proses Impor Gagal .Silahkan Gunakan File Draft Yang Tersedia (Jangan Mengupload File Selain Draft Yang Disediakan)</span><br>";
    } else { //IF 2



        //upload data excel kedalam folder upload
        $target_dir = "upload/" . basename($_FILES['fileToUpload']['name']);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir);

        $spreadsheet = $Reader->load($target_dir);
        $worksheet = $spreadsheet->getActiveSheet();
        $worksheet_arr = $worksheet->toArray();

        $sukses = 0;
        foreach ($worksheet_arr as $Key => $Row) {
            // import data excel mulai baris ke-2 (karena ada header pada baris 1)
            // echo $Key;
            if ($Key <= 0) continue;


            $barcode = $Row[0];
            $id_produk_kategori = $Row[1];
            $nama = trim(strtoupper($Row[2]));
            $satuan = $Row[3];
            $keterangan = trim($Row[4]);
            $gambar = '';
            $hpp = $Row[5];
            $hpp_awal = 0;
            $qty = 0;
            // $qty = $Row[6];
            $qty_awal = 0;
            $harga_jual = $Row[5];
            $stok_min = 0;
            $servis = 0;
            $konsinyasi = 0;

            $sql1 = "SELECT * from produk where nama='$nama'";
            $q1 = mysqli_query($koneksi, $sql1);
            $val1 = mysqli_num_rows($q1);

            if ($val1 >= 1) {
                $pesan .= "Gagal Impor Baris Ke : " . $Key . " Karena Barang <b>".$nama."</b> Sudah Terdaftar Di Database<br>";
                $sukses = 0;
                break;
            } else {

                $sql2 = "SELECT * from produk_kategori where id_produk_kategori=$id_produk_kategori";
                $q2 = mysqli_query($koneksi, $sql2);
                $val1 = mysqli_num_rows($q2);
                if ($val1 < 1) {
                    $sukses = 0;
                    $pesan .= "Gagal Impor Baris Ke : " . $Key . " ID Kategori Produk Tidak Ditemukan <br>";
                    break;
                } else {
                    $query = "INSERT INTO produk (id_produk, barcode, id_produk_kategori, nama, satuan, keterangan, gambar, hpp, hpp_awal, qty, qty_awal, harga_jual, stok_min, servis, konsinyasi, dibuat_pada, diubah_pada) VALUES (DEFAULT, '$barcode', $id_produk_kategori, '$nama', '$satuan', '$keterangan', '$gambar', $hpp, $hpp_awal, $qty, $qty_awal, $harga_jual, $stok_min, $servis, $konsinyasi, DEFAULT, DEFAULT)";
                    // echo $query;
                    mysqli_query($koneksi, $query);
                    if (mysqli_affected_rows($koneksi) > 0) {
                        $sukses++;
                    } else {
                        $sukses = 0;
                        $pesan .= "Gagal Impor Baris Ke : " . $Key . " Format Keterangan Salah <br>";
                    }
                }
            }
        } // Tutup Each
        date_default_timezone_set('Asia/Singapore');
        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');
        $date = date_create();
        $input_id = date_timestamp_get($date);
        $now = date('Y_m_d_H_i_s');
        $jd = $Key - 0;
        rename($target_dir, "upload/ImporInventaris_" . $now . "." . $imageFileType);
        if ($sukses > 1) {
            mysqli_query($koneksi, "COMMIT");
            $msg = "<span class='badge badge-success'>Berhasil Menambahkan : " . $sukses . " Baris Dari " . $jd . " Data </span><br>";
            pesan_transaksi($koneksi);
        } else {
            mysqli_query($koneksi, "ROLLBACK");
            $msg = "<span class='badge badge-danger'>" . $pesan . "</span><br>";
        }
    } // Tutup If 2

} // Tutup If 1
?>

<!-- Tampilan Tambah Tabel Pelanggan -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Impor Katalog Produk</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
                        <li class="breadcrumb-item"><a href="index.php?p=produk">Produk</a></li>
                        <li class="breadcrumb-item active">Impor Inventaris</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <row>
                <!-- left column -->
                <div class="col-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <h3>Formulir Impor Inventaris</h3>
                        </div>
                        <div class="card-body">
                            <a href="draft/DraftImportKatalog.xlsx" target="blank"><button class="btn btn-success"><i class="fas fa-download"></i> Unduh Draft</button></a>
                            <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalCariUnit">
                                <i class="fas fa-search"></i> Cari ID Unit</button>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCariKode">
                                <i class="fas fa-search"></i> Cari ID Barang</button> -->
                            <br>
                            <?php
                            if (isset($_POST['upload'])) {

                                echo $msg;
                            } else {
                                // echo $msg;
                            }
                            ?>
                            <!-- Isian Form -->
                            Untuk menambahkan katalog barang dengan fitur import silahkan gunakan draft file excel pada tombol unduh draft kemudian isi data sesuai keterangan kolom . Pastikan anda mengisi kolom id_produk_kategori sesuai dengan data yang ada.
                            <form method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="fileToUpload">Upload File</label>
                                    <input type="file" required="" class="form-control" name="fileToUpload" id="fileToUpload">
                                </div>

                                <button type="submit" name="upload" class="btn btn-primary">Proses</button>

                            </form>

                        </div>
                    </div>
                </div>
            </row>


        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- Main content -->
