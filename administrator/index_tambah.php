<?php
include '../koneksi.php';

$idpelanggan = $_POST['idpelanggan'];
$tanggal = $_POST['tanggal'];

mysqli_query($koneksi,"insert into pesanan values ('','$tanggal','$idpelanggan')");
header('location:index.php?info=simpan')

?>