    <?php
    session_start();  
    $nik = $_GET['nik'];

    include '../../../config/koneksi.php';
  
    $hapus     = "DELETE FROM tm_user WHERE nik=$nik";
    $query     = mysqli_query($conn, $hapus);

    if ($query) {
        $_SESSION["status"] = 'success';
        $_SESSION["pesan"] = 'Data Berhasil Dihapus';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_user'>";
    } else {
        $_SESSION["status"] = 'error';
        $_SESSION["pesan"] = 'Data Gagal Dihapus';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_user'>";
    }
    ?>