<?php
include '../koneksi.php';

//hapus produk pesanan
if (isset($_POST['hapusprodukpesanan'])) {
    $idp = $_POST['idp'];
    $idpr = $_POST['idpr'];
    $idorder = $_POST['idorder'];

    //cek qty sekarang
    $cek1 = mysqli_query($koneksi,"select * from detailpesanan where iddetailpesanan='$idp'");
    $cek2 = mysqli_fetch_array($cek1);
    $qtysekarang = $cek2['qty'];

    //cek stock sekarang
    $cek3 = mysqli_query($koneksi,"select * from produk where idproduk='$idpr'");
    $cek4 = mysqli_fetch_array($cek3);
    $stocksekarang = $cek4['stock'];

    $hitung = $stocksekarang+$qtysekarang;

    $update = mysqli_query($koneksi,"update produk set stock='$hitung' where idproduk='$idpr'");
    $hapus = mysqli_query($koneksi,"delete from detailpesanan where idproduk='$idpr' and iddetailpesanan='$idp'");

    if ($update&&$hapus) {
        header('location:view.php?idp='.$idorder);
    } else {
        echo '
        <script>alert("gagal menghapus barang");
        window.location.href="view.php?idp='.$idorder.'"</script>
        ';
    }
    
}

?>