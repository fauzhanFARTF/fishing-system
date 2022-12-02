
<?php
    // error_reporting(0);
    session_start();
    include '../../../config/koneksi.php';

    $kd_transaksi = $_GET['kd_transaksi'];
    $quw = mysqli_query($conn, "SELECT * FROM td_pesanan INNER JOIN tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE kd_transaksi=$kd_transaksi");
    $jj = mysqli_fetch_array($quw);
    $qt = $jj['qty'];
    $kol = $jj['id_kolam'];

    if ($kol == 1) {
        $kapasitas = $jj["kapasitas"] + $qt;

        if ($kapasitas >= 50) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Sudah Melebihi Stok!';
            // echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
            // echo "<script type='text/javascript'>alert('Sudah Melebihi Stok!');history.go(-1);</script>";
        } else {
            $tamm = mysqli_query($conn, "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$kol'");
        }
    } else {
        $kapasitas1 = $jj["kapasitas"] + $qt;

        if ($kapasitas1 >= 50) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Sudah Melebihi Stok!';
            // echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
            // echo "<script type='text/javascript'>alert('Sudah Melebihi Stok!');history.go(-1);</script>";
        } else {
            $tamm1 = mysqli_query($conn, "UPDATE tm_kolam SET kapasitas='$kapasitas1' WHERE id_kolam='$kol'");
        }
    }
    $username = $_SESSION['username'];
    $hapus     = "UPDATE td_pesanan SET status='Ditolak', usercreate='$username' WHERE kd_transaksi='$kd_transaksi'";
    $query     = mysqli_query($conn, $hapus); 
    

    if ($query) {
        $_SESSION["status"] = 'success';
        $_SESSION["pesan"] = 'Data Berhasil Dihapus';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
    } else {
        $_SESSION["status"] = 'error';
        $_SESSION["pesan"] = 'Data Gagal Dihapus';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
    }
    

?>