 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Produk</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">
             <li class="breadcrumb-item"><a href="#">Data Pokok</a></li>
             <li class="breadcrumb-item active"> Produk</li>
           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <row>
         <div class="col-12">
           <div class="card">
             <div class="card-header">
               <h3>Data Produk</h3>
             </div>
             <div class="card-body">
               <a href="index.php?p=produk-tambah"><button type="button" class="btn btn-primary mb-2">
                   <i class="fas fa-plus"></i> Tambah</button></a>
               <a href="index.php?p=produk-impor"><button type="button" class="btn btn-success mb-2">
                   <i class="fas fa-upload"></i> Impor</button></a>
               <a href="aksi/produk.php?aksi=buang-spasi"><button type="button" class="btn btn-warning mb-2">
                   <i class="fas fa-cut"></i> Buang Spasi</button></a>
               <a href="aksi/produk.php?aksi=set-kapital"><button type="button" class="btn btn-info mb-2">
                   <i class="fas fa-font"></i> Kapital</button></a>

               <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#setHarga"><i class="fas fa-calculator"></i> Setup Harga</button>

               <table id="example1" class="table table-bordered table-striped">
                 <!-- Kepala Tabel -->
                 <thead>
                   <tr>
                     <td>ID</td>
                     <td>Nama Produk</td>
                     <td>Barcode</td>
                     <td>Kategori</td>
                     <td>Stok</td>
                     <td>Harga Modal</td>
                     <td>Harga Jual</td>
                     <td>Satuan</td>
                     <td>Aksi</td>
                   </tr>
                 </thead>
                 <!-- Isi Tabel -->
                 <?php
                  $sql = "select produk.*,produk_kategori from produk,produk_kategori where produk.id_produk_kategori=produk_kategori.id_produk_kategori order by nama";
                  $query = mysqli_query($koneksi, $sql);
                  while ($kolom = mysqli_fetch_array($query)) {
                  ?>
                   <tr>
                     <td><?= $kolom['id_produk']; ?></td>
                     <td><?= $kolom['nama']; ?></td>
                     <td><?= $kolom['barcode']; ?></td>
                     <td><?= $kolom['produk_kategori']; ?></td>
                     <td><?= number_format($kolom['qty']); ?></td>
                     <td><?= number_format($kolom['hpp']); ?></td>
                     <td><?= number_format($kolom['harga_jual']); ?></td>
                     <td><?= $kolom['satuan']; ?></td>
                     <td>
                       <button type="button" class="btn btn-link"><a href="index.php?p=produk-ubah&id=<?= $kolom['id_produk']; ?>"><i class="fas fa-edit"></i></a></button>
                       <button type="button" class="btn btn-link"><a onclick="return confirm('Data yang dapat dihapus adalah data yang tidak tercatat pada transaksi pembelian ataupun penjualan,Apakah anda yakin data ini dihapus??')" href="aksi/produk.php?aksi=hapus&token=<?= md5($kolom['id_produk']); ?>"><i class="fas fa-trash"></i></a></button>
                     </td>
                   </tr>

                 <?php
                  }
                  ?>
               </table>
             </div>
           </div>
         </div>
       </row>


     </div><!-- /.container-fluid -->

   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <!-- Modal Set Harga -->
 <div class="modal fade" id="setHarga" tabindex="-1" aria-labelledby="setHargaLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="setHargaLabel">Setup Harga</h5>
         <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body">
         <form action="aksi/produk.php" method="post">
          <input type="hidden" name="aksi" value="set-harga">
           <label for="set_harga">Persentase Margin Dari Harga Pokok(%)</label>
           <input type="number" name="set_harga" min="1" value="0" class="form-control" required>

       </div>
       <div class="modal-footer">
         <button class='btn btn-info' type='submit'><i class='fas fa-check'></i> Proses</button>
         </form>
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
       </div>
     </div>
   </div>
 </div>