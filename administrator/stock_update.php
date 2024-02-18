<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idproduk = $_POST['idproduk'];
$namaproduk = $_POST['namaproduk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];

//menginput data ke database
mysqli_query($koneksi,"update produk set namaproduk='$namaproduk', deskripsi='$deskripsi', harga='$harga' where idproduk='$idproduk'");

//mengalihkan halaman kembali ke outlet.php
header("location:stock.php?info=update");
?>
