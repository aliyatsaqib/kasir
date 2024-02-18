<?php
include '../koneksi.php';

$idproduk = $_POST['idproduk'];
$qty = $_POST['qty'];
$tanggalmasuk = $_POST['tanggalmasuk'];

mysqli_query($koneksi,"insert into masuk values ('','$idproduk','$qty','$tanggalmasuk')");
header('location:masuk.php?info=simpan')

?>