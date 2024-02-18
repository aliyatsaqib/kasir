<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idorder = $_GET['idorder'];

//menginput data ke database
mysqli_query($koneksi,"delete from pesanan where idorder='$idorder'");

//mengalihkan halaman kembali ke outlet.php
header("location:index.php?info=hapus");
?>
