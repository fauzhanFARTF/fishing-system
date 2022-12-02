<?php
//include '../config/koneksi.php';

include 'koneksi.php';

$nik = $_GET["nik"];
$today=date("Ymd");

$query = "SELECT * FROM tm_user WHERE nik = '$nik'";
$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);

$nik = $row['nik'];
$namaLengkap = $row['nama_lengkap'];

echo $namaLengkap;

// var_dump($nik);
// var_dump($namaLengkap);

?>