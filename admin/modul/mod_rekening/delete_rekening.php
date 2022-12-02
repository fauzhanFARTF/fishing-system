<?php
session_start();
include '../../../config/koneksi.php';

$no_rek = $_GET['no_rek'];

$hapus      = "DELETE FROM tm_rekening WHERE no_rek=$no_rek";
$query     = mysqli_query($conn, $hapus);

if ($query) {
    $_SESSION["status"] = 'success';
    $_SESSION["pesan"] = 'Data Berhasil Dihapus';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_rekening'>";
} else {
    $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Dihapus';
    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_rekening'>";
}
