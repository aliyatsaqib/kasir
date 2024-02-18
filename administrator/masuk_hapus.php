<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idmasuk = $_GET['idmasuk'];

//menginput data ke database
mysqli_query($koneksi,"delete from masuk where idmasuk='$idmasuk'");

//mengalihkan halaman kembali ke outlet.php
header("location:masuk.php?info=hapus");
?>
