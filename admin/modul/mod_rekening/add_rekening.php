<?php
session_start();
error_reporting(0);

include '../../../config/koneksi.php';

$bank       = $_POST["bank"];
$no_rek   = $_POST["no_rek"];
$atasnama = $_POST["atas_nama"];

$insert = "INSERT INTO tm_rekening VALUES ('$no_rek', '$bank','$atasnama')";

$simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));

if ($simpan) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../../../admin/admin.php?halaman=manajemen_rekening">';
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Ditambah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../../../admin/admin.php?halaman=manajemen_rekening">';
}

?>

<!-- <META HTTP-EQUIV="REFRESH" CONTENT="0; URL=../../../admin/admin.php?halaman=manajemen_rekening"> -->