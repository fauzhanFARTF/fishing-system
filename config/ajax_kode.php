<?php

include 'koneksi.php';

$id_kolam = $_GET["id_kolam"];
date_default_timezone_set('Asia/Jakarta');
$today=date("Ymd");

$query = "SELECT * FROM tm_kolam WHERE id_kolam = '$id_kolam'";
$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);

if ($id_kolam != 0) {

    $query1 = mysqli_query($conn,"SELECT max(kd_transaksi) AS last FROM td_pesanan WHERE kd_transaksi LIKE '$today%'");
    $data = mysqli_fetch_array($query1);
    $lastnotransaksi = $data['last'];
    $lastnourut = substr($lastnotransaksi,8,4);
    $nextnourut = $lastnourut+1;

    $kdtransaksi =  $today.sprintf('%04s',$nextnourut);
} else {
        $kdtransaksi =  "";
}

echo $kdtransaksi;
