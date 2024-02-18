<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../koneksi.php';
require 'function.php';

if (isset($_GET['idp'])) {
    $idp = $_GET['idp'];

    $ambilnamapelanggan = mysqli_query($koneksi, "select *from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan and p.idorder='$idp'");
    $np = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $np['namapelanggan'];
} else {
    header('location=index.php');
}


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pesanan : <?= $idp; ?></h1>
                    <h4 class="m-0">Nama Pelanggan : <?= $namapel; ?></h4>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Barang</h3>
                            <div class="card-tools">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Sub-Total</th>
                                        <th style="width: 205px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $d_pesanan = mysqli_query($koneksi, "select * from produk p, detailpesanan dp where p.idproduk=dp.idproduk and idpesanan='$idp'");
                                    while ($d_d_pesanan = mysqli_fetch_array($d_pesanan)) {
                                        $idpr = $d_d_pesanan['idproduk'];
                                        $iddp = $d_d_pesanan['iddetailpesanan'];
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $d_d_pesanan['namaproduk'] ?> [<?= $d_d_pesanan['deskripsi'] ?>]</td>
                                            <td><?= $d_d_pesanan['harga'] ?></td>
                                            <td><?= $d_d_pesanan['qty'] ?></td>
                                            <td>
                                                <?php
                                                $harga = $d_d_pesanan['harga'];
                                                $qty = $d_d_pesanan['qty'];
                                                $total = $harga * $qty; ?>
                                                Rp.<?= number_format($total); ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"> Edit</i></button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?= $d_d_pesanan['idproduk'] ?>"><i class="fas fa-trash"> Hapus</i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-hapus<?= $d_d_pesanan['idproduk'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Barang Masuk</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus data <b><?= $d_d_pesanan['namaproduk'] ?> [<?= $d_d_pesanan['deskripsi'] ?>]</b> ini ... ?</p>
                                                        <input type="hidden" name="idp" value="<?=$iddp;?>">
                                                        <input type="hidden" name="idpr" value="<?=$idpr;?>">
                                                        <input type="hidden" name="idorder" value="<?=$idp;?>">
                                                        
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-success" name="hapusprodukpesanan">Ya</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <h4>Total Barang : </h4>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" action="view_tambah.php">
                    <div class="modal-body">
                        <div class="form-grup">
                            <label>Pilih Barang</label>
                            <select name="idproduk" class="form-control">
                                <option>--- Pilih Barang ---</option>
                                <?php
                                $getproduk = mysqli_query($koneksi, "select * from produk");
                                //produk where idproduk not like (select idproduk from detailpesanan where idpesanan='$idorder'));
                                while ($pl = mysqli_fetch_array($getproduk)) { ?>
                                    <option value="<?= $pl['idproduk'] ?>"><?= $pl['namaproduk'] ?> - <?= $pl['deskripsi'] ?> (Stock : <?= $pl['stock'] ?>)</option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="form-grup">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="qty" required>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="idp" value="<?= $idp; ?>">
                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>


<?php
include '../layouts/footer.php';
?>