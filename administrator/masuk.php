<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../koneksi.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Barang Masuk</h1>
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
                            <h3 class="card-title">Data Barang Masuk</h3>

                            <div class="card-tools">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"></i> Tambah Data</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $d_produk = mysqli_query($koneksi, "select * from produk p, masuk m where p.idproduk=m.idproduk");
                                    while ($d_d_produk = mysqli_fetch_array($d_produk)) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?= $d_d_produk['namaproduk'] ?> - <?= $d_d_produk['deskripsi'] ?></td>
                                            <td><?= $d_d_produk['qty'] ?></td>
                                            <td><?= $d_d_produk['tanggalmasuk'] ?></td>
                                            <td><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_d_produk['idmasuk']; ?>"><i class="fas fa-edit"> Edit</i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_d_produk['idmasuk']; ?>"><i class="fas fa-trash"> Hapus</i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-hapus<?php echo $d_d_produk['idmasuk']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Barang Masuk</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus data <b><?php echo $d_d_produk['namaproduk']; ?></b> ini ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <a href="masuk_hapus.php?idmasuk=<?php echo $d_d_produk['idmasuk']; ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal-edit<?php echo $d_d_produk['idmasuk']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Data Barang Masuk</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <form method="post" action="masuk_update.php">
                                                        <div class="modal-body">
                                                            <div class="form-grup">
                                                                <label>Nama Barang</label>
                                                                <input type="text" class="form-control" name="idp" value="<?= $d_d_produk['idproduk'] ?>" hidden>
                                                                <input type="text" class="form-control" name="idm" value="<?= $d_d_produk['idmasuk'] ?>" hidden>
                                                                <input type="text" class="form-control" value="<?= $d_d_produk['namaproduk'] ?> - <?= $d_d_produk['deskripsi'] ?>" disabled>
                                                            </div>
                                                            <div class="form-grup">
                                                                <label>Jumlah</label>
                                                                <input type="number" class="form-control" name="qty" value="<?= $d_d_produk['qty'] ?>">
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

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
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
                    <h4 class="modal-title">Tambah Data Barang Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" action="masuk_tambah.php">
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
                        <div class="form-grup" hidden>
                            <label>Tanggal</label>
                            <input type="text" name="tanggalmasuk" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly="">
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