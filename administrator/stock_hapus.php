<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idproduk = $_GET['idproduk'];

//menginput data ke database
mysqli_query($koneksi,"delete from produk where idproduk='$idproduk'");

//mengalihkan halaman kembali ke outlet.php
header("location:stock.php?info=hapus");
?>
