<?php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['role'] == "administrator") {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = "administrator";
        header("location:administrator");
    } else if ($data['role'] == "petugas") {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['role'] = "owner";
        header("location:petugas");
    } else {
        header("location:index.php?info=gagal");
    }
} else {
    header("location:index.php?info=gagal");
}
