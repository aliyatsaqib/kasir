<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idpelanggan = $_GET['idpelanggan'];

//menginput data ke database
mysqli_query($koneksi,"delete from pelanggan where idpelanggan='$idpelanggan'");

//mengalihkan halaman kembali ke outlet.php
header("location:pelanggan.php?info=hapus");
?>
