<?php
session_start();
include '../../../config/koneksi.php';

$id_kolam = $_GET['id_kolam'];

$hapus      = "DELETE FROM tm_kolam WHERE id_kolam='$id_kolam'";
$query     = mysqli_query($conn, $hapus);

if ($query) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Dihapus';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_kolam'>";
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Dihapus';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_kolam'>";
}
