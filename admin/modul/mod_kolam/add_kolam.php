    <?php
    session_start();
    //error_reporting(0);
    
    include '../../../config/koneksi.php';

    $kd_kolam       = $_POST["kd_kolam"];
    $title       = $_POST["title"];
    $detail       = $_POST["detail"];
    $harga    = $_POST["harga"];
    $kapasitas          = $_POST["kapasitas"];

    if (isset($_POST['submit'])) {
        $temp = $_FILES['pic']['tmp_name'];
        $name = rand(0, 9999) . $_FILES['pic']['name'];
        $size = $_FILES['pic']['size'];
        $type = $_FILES['pic']['type'];
        $folder = "../../../uploads/";

        if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
            move_uploaded_file($temp, $folder . $name);
            $insert = "INSERT INTO tm_kolam VALUES (NULL,'$kd_kolam','$title','$detail', '$name', '$harga', '$kapasitas')";

            $simpan = mysqli_query($conn, $insert) or die(mysqli_error($conn));

            if ($simpan) {
                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Data Berhasil Ditambah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
            } else {
                $_SESSION["status"] = 'error';
                $_SESSION["pesan"] = 'Data Gagal Ditambah';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
            }
        } else {
            $_SESSION["status"] = 'warning';
            $_SESSION["pesan"] = 'Gagal Upload Gambar';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
        }
    }
    ?>