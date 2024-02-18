<?php
include '../layouts/header.php';
include '../layouts/navbar.php';
include '../koneksi.php';

$h1 = mysqli_query($koneksi, "select*from pelanggan");
$h2 = mysqli_num_rows($h1);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pelanggan</h1>
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
                        <div class="card-body">Jumlah Pelanggan : <?= $h2; ?></div>
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
                            <h3 class="card-title">Data Pelanggan</h3>

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
                                        <th>Nama Pelanggan</th>
                                        <th>No Telephone</th>
                                        <th>Alamat</th>
                                        <th style="width: 200px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $d_pelanggan = mysqli_query($koneksi, "select * from pelanggan");
                                    while ($d_d_pelanggan = mysqli_fetch_array($d_pelanggan)) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?= $d_d_pelanggan['namapelanggan'] ?></td>
                                            <td><?= $d_d_pelanggan['notelp'] ?></td>
                                            <td><?= $d_d_pelanggan['alamat'] ?></td>
                                            <td><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $d_d_pelanggan['idpelanggan']; ?>"><i class="fas fa-edit"> Edit</i></button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-hapus<?php echo $d_d_pelanggan['idpelanggan']; ?>"><i class="fas fa-trash"> Hapus</i></button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-hapus<?php echo $d_d_pelanggan['idpelanggan']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data Pelanggan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus data <b><?php echo $d_d_pelanggan['namapelanggan']; ?></b> ini ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <a href="pelanggan_hapus.php?idpelanggan=<?php echo $d_d_pelanggan['idpelanggan']; ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="modal-edit<?php echo $d_d_pelanggan['idpelanggan']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update Data pelanggan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form method="post" action="pelanggan_update.php">
                                                        <div class="modal-body">
                                                            <div class="form-grup">
                                                                <label>Nama</label>
                                                                <input type="text" name="idpelanggan" value="<?php echo $d_d_pelanggan['idpelanggan']; ?>" hidden>
                                                                <input type="text" name="namapelanggan" value="<?php echo $d_d_pelanggan['namapelanggan']; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-grup">
                                                                <label>No Telephone</label>
                                                                <input type="number" name="notelp" value="<?php echo $d_d_pelanggan['notelp']; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-grup">
                                                                <label>alamat</label>
                                                                <input type="text" name="alamat" value="<?php echo $d_d_pelanggan['alamat']; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                                            <button type="submit" class="btn btn-primary">Update</button>
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
                    <h4 class="modal-title">Tambah Data pelanggan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form method="post" action="pelanggan_tambah.php">
                    <div class="modal-body">
                        <div class="form-grup">
                            <label>Nama</label>
                            <input type="text" name="namapelanggan" placeholder="Masukkan Nama pelanggan" class="form-control">
                        </div>
                        <div class="form-grup">
                            <label>No Telephone</label>
                            <input type="number" name="notelp" placeholder="Masukkan No Telephone" class="form-control">
                        </div>
                        <div class="form-grup">
                            <label>alamat</label>
                            <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control">
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