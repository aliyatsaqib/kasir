<?php
include '../koneksi.php';

$namapelanggan = $_POST['namapelanggan'];
$notelp = $_POST['notelp'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi,"insert into pelanggan values ('','$namapelanggan','$notelp','$alamat')");
header('location:pelanggan.php?info=simpan')

?>