<?php
session_start();

$id_konfirm = $_POST['id_konfirm'];


$kd_transaksi= $_POST['kd_transaksi'];

include '../../../config/koneksi.php';
$query    = "UPDATE td_pesanan SET status='Sudah Terkonfirmasi' WHERE kd_transaksi='$kd_transaksi'";
$query2    = "UPDATE td_konfirmasi SET sts='Bukti Pembayaran Diterima' WHERE id_konfirm='$id_konfirm'";
$update   = mysqli_query($conn, $query) or die(mysqli_error($conn));
$update2   = mysqli_query($conn, $query2) or die(mysqli_error($conn));

if ($update) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Di Konfirmasi';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi">';
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Di Konfirmasi';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi">';
}
