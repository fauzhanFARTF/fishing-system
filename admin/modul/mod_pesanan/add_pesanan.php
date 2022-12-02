    <?php
    // error_reporting(0);
    session_start();
    include '../../../config/koneksi.php';

    $kd_transaksi       = $_POST['kd_transaksi'];
    $id_kolam           = $_POST['id_kolam'];
    $nik                = $_POST['nik'];
    date_default_timezone_set('Asia/Jakarta');
    $timestamp          = date('Y-m-d H:i:s'); 
    $date               = date('H:i:s');             // set date otomatis
    $tanggal            = strtotime($_POST['tanggal']);
    $tgl                = date('Y-m-d', $tanggal);
    $jml_org            = $_POST['jml_org'];
    $total_harga        = $_POST['total_harga'];
    $usercreate         = "member_".$_SESSION['username'];
    $jam                = $_POST['jam']; // set jam pagi

// cek kolam/kapasitas kolam
$upque = "SELECT * FROM tm_kolam WHERE id_kolam = '$id_kolam'";
$sql = mysqli_query($conn, $upque) or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);
$kapasitas = $row["kapasitas"] - $jml_org;

if($nama_lengkap = "" ){
     $_SESSION["status"] = 'error';
    $_SESSION["pesan"] = 'Data Gagal Ditambah';
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
} else {
    if ($id_kolam == 1) {
        if ($kapasitas <= 0) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal di tambahkan kapasitas penuh';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            // echo "<script type='text/javascript'>alert('Gagal di tambahkan kapasitas penuh!');history.go(-1);</script>";

        } else {
            $kol = "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
            $sql2 = mysqli_query($conn, $kol) or die(mysqli_error($conn));

            if (empty($jam) && empty($jam1)) {
    
                $insert = "INSERT INTO td_pesanan VALUES ('$kd_transaksi','$id_kolam', '$nik', '$jml_org', '$total_harga', '$tgl', 'Proses Pemesanan', '$timestamp','$usercreate')";
                $simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));
                if ($simpan) {
                    $_SESSION["status"] = 'success';
                    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
                } else {
                    $_SESSION["status"] = 'error';
                    $_SESSION["pesan"] = 'Data Gagal Ditambah';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
                }
            }
            if (isset($_POST['jam']) == $jam) {

                $insert3 = "INSERT INTO td_pesanan VALUES ('$kd_transaksi','$id_kolam', '$nik', '$jml_org', '$total_harga', '$tgl', 'Proses Pemesanan', '$timestamp','$usercreate', '$jam')";
                $simpan = mysqli_query($conn, $insert3) or die(mysqli_error($conn));
                if ($simpan) {
                    $_SESSION["status"] = 'success';
                    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
                } else {
                    $_SESSION["status"] = 'error';
                    $_SESSION["pesan"] = 'Data Gagal Ditambah';
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
                }
            }
        }
    } else {

        if ($kapasitas <= 0) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal di tambahkan kapasitas penuh';
            echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
            // echo "<script type='text/javascript'>alert('Gagal di tambahkan kapasitas penuh!');history.go(-1);</script>";
        } else {
            $kol = "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
            $sql2 = mysqli_query($conn, $kol) or die(mysqli_error($conn));

            if (empty($jam) && empty($jam1)) {

                $insert = "INSERT INTO td_pesanan VALUES ('$kd_transaksi','$id_kolam', '$nik', '$jml_org', '$total_harga', '$tgl', 'Proses Pemesanan', '$timestamp','$usercreate')";
                $simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));
                if ($simpan) {
                    $_SESSION["status"] = 'success';
                    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
                } else {
                    $_SESSION["status"] = 'error';
                    $_SESSION["pesan"] = 'Data Gagal Ditambah';
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT ='0; URL=../../../admin/admin.php?halaman=manajemen_pesanan'>";
                }
            }
            if (isset($_POST['jam']) == $jam) {

                $insert3 = "INSERT INTO td_pesanan VALUES ('$kd_transaksi','$id_kolam', '$nik', '$jml_org', '$total_harga', '$tgl', 'Proses Pemesanan', '$timestamp','$usercreate', '$jam')";
                $simpan = mysqli_query($conn, $insert3) or die(mysqli_error($conn));
                if ($simpan) {
                    $_SESSION["status"] = 'success';
                    $_SESSION["pesan"] = 'Data Berhasil Ditambah';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
                } else {
                    $_SESSION["status"] = 'error';
                    $_SESSION["pesan"] = 'Data Gagal Ditambah';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
                }
            }
        }
    }
}