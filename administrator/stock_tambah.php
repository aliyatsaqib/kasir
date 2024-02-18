<?php
include '../koneksi.php';

$namaproduk = $_POST['namaproduk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$stock = $_POST['stock'];

mysqli_query($koneksi,"insert into produk values ('','$namaproduk','$deskripsi','$harga','$stock')");

header('location:stock.php?info=simpan');

?>