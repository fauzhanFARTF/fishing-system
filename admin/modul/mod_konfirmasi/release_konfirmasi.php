    <?php
    // error_reporting(0);
    session_start();
    include '../../../config/koneksi.php';

    $id_konfirm = $_GET['id_konfirm'];
    $quw = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_konfirmasi ON td_konfirmasi.kd_transaksi = td_pesanan.kd_transaksi WHERE id_konfirm='$id_konfirm'");
    $jj = mysqli_fetch_array($quw);

    $qt = $jj['qty'];
    $kol = $jj['id_kolam'];
    $kd_transaksi = $jj['kd_transaksi'];
    $status = $jj['status'];
    date_default_timezone_set('Asia/Jakarta');
    $timestamp          = date('Y-m-d H:i:s'); 


    if ($status == "Belum Terkonfirmasi"){
        $_SESSION["status"] = 'error';
        $_SESSION["pesan"] = 'Data yang Belum Dikonfirmasi Tidak Bisa Di Release, Cek Kembali Pilihan'; 
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
    } else {
        if ($kol == 1) {
            $tam = mysqli_query($conn, "SELECT * FROM tm_kolam WHERE id_kolam = '$kol'");
            $bah = mysqli_fetch_array($tam);
            $kapasitas = $bah["kapasitas"] + $qt;

            if ($kapasitas > 40) {
                $_SESSION["status"] = 'warning';
                $_SESSION["pesan"] = 'Sudah Melebihi Stok!';
                echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
                    // echo "<script type='text/javascript'>alert('Sudah Melebihi Stok!');history.go(-1);</script>";
            } else {
                $tamm = mysqli_query($conn, "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$kol'");
                $quww = mysqli_query($conn, "UPDATE td_pesanan SET status='Transaksi Sudah Selesai', timestamp='$timestamp' WHERE kd_transaksi='$kd_transaksi'");
                $quwww = mysqli_query($conn, "UPDATE td_konfirmasi SET sts='Transaksi Sudah Selesai', timestamp='$timestamp' WHERE id_konfirm='$id_konfirm'");
            }

        } else {
                $tam1 = mysqli_query($conn, "SELECT * FROM tm_kolam WHERE id_kolam = '$kol'");
                $bah1 = mysqli_fetch_array($tam1);
                $kapasitas1 = $bah1["kapasitas"] + $qt;

            if ($kapasitas1 > 30) {
                $_SESSION["status"] = 'warning';
                $_SESSION["pesan"] = 'Sudah Melebihi Stok!';
                echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
                    // echo "<script type='text/javascript'>alert('Sudah Melebihi Stok!');history.go(-1);</script>";
            } else {
                $tamm1 = mysqli_query($conn, "UPDATE tm_kolam SET kapasitas='$kapasitas1' WHERE id_kolam='$kol'");
                $quww1 = mysqli_query($conn, "UPDATE td_pesanan SET status='Transaksi Sudah Selesai', timestamp='$timestamp' WHERE kd_transaksi='$kd_transaksi'");
                $quwww1 = mysqli_query($conn, "UPDATE td_konfirmasi SET sts='Transaksi Sudah Selesai', timestamp='$timestamp' WHERE id_konfirm='$id_konfirm'");
            }
        }
            $insert = mysqli_query($conn, "INSERT INTO td_transaksi_selesai VALUES (NULL,'$kd_transaksi')");
            // $hapus      = "DELETE FROM td_konfirmasi WHERE id_konfirm='$id_konfirm'";
            // $query     = mysqli_query($conn, $hapus);

            if ($quw) {
                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Data Berhasil DiRelease';
                echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
            } else {
                $_SESSION["status"] = 'warning';
                $_SESSION["pesan"] = 'Data yang Belum  Dikonfirmasi Tidak Bisa Di Release, Silahkan Konfirm atau Tolak Pemesanan !';
                echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
            }
    }

    
 ?>