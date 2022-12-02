<?php
session_start();
include '../../../config/koneksi.php';
// $conn = mysqli_connect("localhost", "root", "", "kontrakan");

$bank         = $_POST['bank'];
$no_rek         = $_POST['no_rek'];
$atasnama         = $_POST['atas_nama'];


$update     = "UPDATE tm_rekening SET bank='$bank', no_rek='$no_rek', atas_nama='$atasnama' WHERE no_rek='$no_rek'";
$updaterek    = mysqli_query($conn, $update) or die(mysqli_error($conn));

if ($updaterek) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_rekening">';
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Di Konfirmasi';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_rekening">';
}
