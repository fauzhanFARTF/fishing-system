    <?php

    // error_reporting(0);
    session_start();
    include '../../../config/koneksi.php';

    $kd_transaksi    = $_POST["kd_transaksi"];
    $qty          = $_POST["qty"];
    $temp = $_FILES['bukti']['tmp_name'];
    $name = rand(0, 9999) . $_FILES['bukti']['name'];
    $size = $_FILES['bukti']['size'];
    $type = $_FILES['bukti']['type'];
    $folder = "../../../uploads/";
    $no_rek = $_POST["no_rek"];
    $sts = "Bukti Pembayaran Masuk";
    
    date_default_timezone_set('Asia/Jakarta');
    $timestamp      = date('Y-m-d H:i:s'); 

    $usercreate     = "member_".$_SESSION['username'];

    if (isset($_POST['submit'])) {

        if ($type == 'image/jpeg' || $type == 'image/png' ||  $type == 'image/jpg') {
            move_uploaded_file($temp, $folder . $name);
            $insert = "INSERT INTO td_konfirmasi VALUES (NULL,'$kd_transaksi','$qty','$name', '$timestamp', '$usercreate','$no_rek', '$sts')";
            $simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));
            $insert2 = "UPDATE td_pesanan SET status = 'Belum Terkonfirmasi' WHERE kd_transaksi = '$kd_transaksi'";
            $simpan2 = mysqli_query($conn, $insert2) or die(mysqli_error($conn));

            if ($simpan) {
                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Bukti Pembayaran Berhasil diupload';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi">';
            } else {

                $_SESSION["status"] = 'error';
                $_SESSION["pesan"] = 'Bukti Pembayaran Gagal diupload';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi">';
            }
        } else {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal Upload Gambar';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_konfirmasi">';
        }
    }
    ?>