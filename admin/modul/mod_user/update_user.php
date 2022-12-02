    <?php
    session_start();
    include '../../../config/koneksi.php';
    // $conn = mysqli_connect("localhost", "root", "", "kontrakan");

    $nik          = $_POST['nik'];
    $username     = $_POST['username'];
    $password     = $_POST['password'];
    $namalengkap  = $_POST['nama_lengkap'];
    $email        = $_POST['email'];
    $alamat       = $_POST['alamat'];
    $notelp       = $_POST['no_telp'];
    $level        = $_POST["level"];
    date_default_timezone_set('Asia/Jakarta');
    $timestamp    = date('Y-m-d H:i:s'); 
    $usercreate   = 'admin_'.$_SESSION['username'] ;
    // $password_enc = password_hash($password,PASSWORD_DEFAULT);// $password --> password yang mau diacak, $PASSWORD_DEFAULT --> algoritmanya

    $update     = "UPDATE tm_user SET username='$username', nama_lengkap='$namalengkap', email='$email', alamat='$alamat', no_telp='$notelp', level='$level', timestamp = '$timestamp', usercreate = '$usercreate' WHERE nik='$nik'";
    $updateuser    = mysqli_query($conn, $update) or die(mysqli_error($conn));

    if ($updateuser) {
        $_SESSION["status"] = 'success';
        $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
        echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_user">';
    } else {
        $_SESSION["status"] = 'error';
        $_SESSION["pesan"] = 'Data Gagal Di Ubah';
        echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_user">';
    }

    ?>