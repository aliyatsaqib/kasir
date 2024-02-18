<?php
// koneksi database
include '../koneksi.php';

//menambahkan data yang dikirim dari form
$idpelanggan = $_POST['idpelanggan'];
$namapelanggan = $_POST['namapelanggan'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];

//menginput data ke database
mysqli_query($koneksi,"update pelanggan set namapelanggan='$namapelanggan', notelp='$notelp', alamat='$alamat' where idpelanggan='$idpelanggan'");

//mengalihkan halaman kembali ke outlet.php
header("location:pelanggan.php?info=update");
?>
