<?php
include '../koneksi.php';

$idp = $_POST['idp'];
$idproduk = $_POST['idproduk'];
$qty = $_POST['qty'];

$hitung1 = mysqli_query($koneksi, "select * from produk where idproduk='$idproduk'");
$hitung2 = mysqli_fetch_array($hitung1);
$stoksekarang = $hitung2['stock'];

if ($stoksekarang >= $qty) {
    $selisih = $stoksekarang - $qty;
    $insert = mysqli_query($koneksi, "insert into detailpesanan values ('','$idp','$idproduk','$qty')");
    $update = mysqli_query($koneksi, "update produk set stock='$selisih' where idproduk='$idproduk'");

    if ($insert && $update) {
        header('location:view.php?idp=' . $idp);
    } else {
        echo '
        <script>alert("Gagal menambah pesanan baru");
        window.location.href="view.php?idp='.$idp.'"
        </script>
        ';
    }
} else {
    echo '
        <script>alert("Stok Barang Tidak Cukup");
        window.location.href="view.php?idp='.$idp.'"
        </script>
        ';
}
