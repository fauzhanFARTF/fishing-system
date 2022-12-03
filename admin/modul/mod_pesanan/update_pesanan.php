    <?php
    session_start();
    include '../../../config/koneksi.php';

    $kd_transaksi     = $_POST['kd_transaksi'];
    $id_kolam     = $_POST['id_kolam'];
    $nik             = $_POST['user'];
    $namaLengkap      =$_POST['namaLengkap'];
    $tanggal          = $_POST['tanggal'];
    $jam               =$_POST['jam'];
    $jml_org          = $_POST['jml_org'];
    $total_harga      = $_POST['total_harga'];
  

    $upque = "SELECT * FROM td_pesanan join tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE kd_transaksi = '$kd_transaksi'";
    $sql = mysqli_query($conn, $upque) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($sql);
    $qty = $row['qty'];

    $selisih = $jml_org - $qty;
    if ($selisih<0){
    $kapasitas = $row["kapasitas"] + abs($selisih);
    // echo $kapasitas;
    } else {
    $kapasitas = $row["kapasitas"] - abs($selisih);
    // echo $kapasitas;
    }


    if ($id_kolam == 1) {
        if ($kapasitas <= 0) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal di tambahkan kapasitas penuh';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            // echo "<script type='text/javascript'>alert('Gagal di tambahkan kapasitas penuh!');history.go(-1);</script>";
        } else {
            $kol = "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
            $sql2 = mysqli_query($conn, $kol) or die(mysqli_error($conn));

            $update     = "UPDATE td_pesanan SET 
                id_kolam='$id_kolam', 
                id_jam='$jam', 
                tanggal='$tanggal', 
                qty='$jml_org', 
                total_harga='$total_harga' 
                WHERE kd_transaksi='$kd_transaksi'";

            $updatekolam    = mysqli_query($conn, $update) or die(mysqli_error($conn));

            if ($updatekolam) {
                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            } else {
                $_SESSION["status"] = 'error';
                $_SESSION["pesan"] = 'Data Gagal Di Ubah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            }
        }
    } else {

        if ($kapasitas <= 0) {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal di tambahkan kapasitas penuh';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            // echo "<script type='text/javascript'>alert('Gagal di tambahkan kapasitas penuh!');history.go(-1);</script>";
        } else {
            $kol = "UPDATE tm_kolam SET kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
            $sql2 = mysqli_query($conn, $kol) or die(mysqli_error($conn));

            $update     = "UPDATE td_pesanan SET 
                id_kolam='$id_kolam', 
                id_jam='$jam', 
                tanggal='$tanggal', 
                qty='$jml_org', 
                total_harga='$total_harga'
                WHERE kd_transaksi='$kd_transaksi'";

            $updatekolam    = mysqli_query($conn, $update) or die(mysqli_error($conn));

            if ($updatekolam) {
                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            } else {
                $_SESSION["status"] = 'error';
                $_SESSION["pesan"] = 'Data Gagal Di Ubah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_pesanan">';
            }
        }
    }

    ?>