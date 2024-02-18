<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../koneksi.php';

//hitung jumlah pesanan
$h1 = mysqli_query($koneksi,"select * from pesanan");
$h2 = mysqli_num_rows($h1);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pesanan</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="card-body">Jumlah Pesanan : <?=$h2;?></div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Pesanan</h3>

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
                                        <th>ID Pesanan</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jumlah</th>
                                        <th style="width: 205px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $d_pesanan = mysqli_query($koneksi, "select * from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan");
                                    while ($d_d_pesanan = mysqli_fetch_array($d_pesanan)) {
                                        $idorder = $d_d_pesanan['idorder'];
                                        $hitungjumlah = mysqli_query($koneksi, "select * from detailpesanan where idpesanan='$idorder'");
                                        $jumlah = mysqli_num_rows($hitungjumlah);
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $d_d_pesanan['idorder'] ?></td>
                                            <td><?= $d_d_pesanan['tanggal'] ?></td>
                                            <td><?= $d_d_pesanan['namapelanggan'] ?> - <?= $d_d_pesanan['alamat'] ?></td>
                                            <td><?= $jumlah; ?></td>
                                            <td>
                                                <a href="view.php?idp=<?=$idorder;?>" class="btn btn-warning btn-sm" target="_blank"><i class="fas fa-eye"> Tampilkan</i></a>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?= $d_d_pesanan['idorder'] ?>"><i class="fas fa-trash"> Hapus</i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-hapus<?= $d_d_pesanan['idorder'] ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Barang Masuk</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus data <b><?= $d_d_pesanan['namapelanggan'] ?></b> ini ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <a href="index_hapus.php?idorder=<?= $d_d_pesanan['idorder'] ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                    ?>
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
                    <h4 class="modal-title">Tambah Data Pesanan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" action="index_tambah.php">
                    <div class="modal-body">
                        <div class="form-grup" hidden>
                            <label>Tanggal</label>
                            <input type="text" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly="">
                        </div>
                        <div class="form-grup">
                            <label>Pilih Pelanggan</label>
                            <select name="idpelanggan" class="form-control">
                            <option>--- Pilih Nama Pelanggan ---</option>
                                <?php
                                $getpelanggan = mysqli_query($koneksi, "select * from pelanggan");
                                while ($pl = mysqli_fetch_array($getpelanggan)) { ?>
                                    <option value="<?= $pl['idpelanggan'] ?>"><?= $pl['namapelanggan'] ?> - <?= $pl['alamat'] ?></option>
                                <?php }
                                ?>
                            </select>
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