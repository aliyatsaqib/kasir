<?php
// koneksi database
include '../koneksi.php';

$idm = $_POST['idm']; //idmasuk
$qty = $_POST['qty'];
$idp = $_POST['idp']; //idproduk

$caritau = mysqli_query($koneksi,"select*from masuk where idmasuk='$idmasuk'");
$caritau2 = mysqli_fetch_array($caritau);
$qtysekarang = $caritau2['qty'];

//cari tau stock sekarang
$caristock = mysqli_query($koneksi,"select*from produk where idproduk='$idproduk'");
$stocksekarang2 = mysqli_fetch_array($caristock);
$stocksekarang = $stocksekarang2['stock'];

if ($qty >= $qtysekarang) {
    //kalau inputan user lebih besar daripada qty yg tercatat
    //hitung selisih
    $selisih= $qty-$qtysekarang;
    $newstock = $stocksekarang+$selisih;

    $quary1 = mysqli_query($koneksi,"update masuk set qty='$qty' where idmasuk='$idm'");
    $quary2 = mysqli_query($koneksi,"update produk set stock='$newstock' where idproduk='$idp'");

    if ($quary1&&$quary2) {
        header('location:masuk.php');
    } else {
        echo '
        <script>alert("gagal");
        window.location.href="masuk.php"
        </script>';
    }
    

} else {
    //kalau lehib kecil
    //hitung selisih
    $selisih = $qtysekarang-$qty;
    $newstock = $stocksekarang-$selisih;

    $quary1 = mysqli_query($koneksi,"update masuk set qty='$qty' where idmasuk='$idm'");
    $quary2 = mysqli_query($koneksi,"update produk set stock='$newstock' where idproduk='$idp'");

    if ($quary1&&$quary2) {
        header('location:masuk.php');
    } else {
        echo '
        <script>alert("gagal");
        window.location.href="masuk.php"
        </script>';
    }
}
