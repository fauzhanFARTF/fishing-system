<?php

session_start();
// error_reporting(0);

include '../../../config/koneksi.php';
$nik            = $_POST["nik"];
$username       = $_POST["username"];
$password       = $_POST["password"];
$namalengkap    = $_POST["nama_lengkap"];
$email          = $_POST["email"];
$alamat         = $_POST["alamat"];
$notelp         = $_POST["no_telp"];
$level          = $_POST["level"];
date_default_timezone_set('Asia/Jakarta');
$timestamp      = date('Y-m-d H:i:s'); 

$usercreate        = "admin_".$_SESSION['username'];
$password_enc = password_hash($password,PASSWORD_DEFAULT);// $password --> password yang mau diacak, $PASSWORD_DEFAULT --> algoritmanya


$insert = "INSERT INTO tm_user VALUES ('$nik','$username','$password_enc', '$namalengkap', '$email', '$alamat', '$notelp', '$level','$timestamp', '$usercreate')";

$simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));

if ($simpan) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../../../admin/admin.php?halaman=manajemen_user">';
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Ditambah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../../../admin/admin.php?halaman=manajemen_user">';
}
