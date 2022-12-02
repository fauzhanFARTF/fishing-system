    <?php
    // error_reporting(0);
 
    session_start();
    include '../../../config/koneksi.php';

    $id_konfirm = $_GET['id_konfirm'];

    $qua = mysqli_query($conn, "SELECT td_konfirmasi.*, td_pesanan.*, tm_kolam.* FROM td_konfirmasi JOIN td_pesanan on td_konfirmasi.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_kolam on td_pesanan.id_kolam = tm_kolam.id_kolam WHERE id_konfirm='$id_konfirm'");
    $ja = mysqli_fetch_array($qua);
    $qa = $ja['qty'];
    $kol = $ja['id_kolam'];
    $koe = $ja['id_konfirm'];
    $kapasitas = $ja["kapasitas"];
    $kd_transaksi = $ja['kd_transaksi'];
    date_default_timezone_set('Asia/Jakarta');
    $timestamp          = date('Y-m-d H:i:s'); 
    $sts = "Bukti Pembayaran Ditolak";
    $status = $ja['status'];


    $username = $_SESSION['username'];
    if($status == 'Belum Terkonfirmasi'){
        $hapus     = "UPDATE td_pesanan SET status='Proses Pemesanan', usercreate='$username', timestamp='$timestamp' WHERE kd_transaksi='$kd_transaksi'";
        $query     = mysqli_query($conn, $hapus); 
        $hapus2     = "UPDATE td_konfirmasi SET sts='$sts', timestamp='$timestamp' WHERE id_konfirm='$id_konfirm'";
        $query2     = mysqli_query($conn, $hapus2); 

        if ($query2) {
            $_SESSION["status"] = 'success';
            $_SESSION["pesan"] = 'Data Berhasil Dihapus';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
        } else {
            $_SESSION["status"] = 'error';
            $_SESSION["pesan"] = 'Data Gagal Dihapus';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
        }
    } else {
        $_SESSION["status"] = 'error';
        $_SESSION["pesan"] = 'Data yang Sudah Dikonfirmasi Tidak Bisa Di Hapus, Cek Kembali Pilihan'; 
        echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi'>";
    }


    ?>