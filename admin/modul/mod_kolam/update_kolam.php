<?php
session_start();
include '../../../config/koneksi.php';
// $conn = mysqli_connect("localhost", "root", "", "kolam");

$id_kolam    = $_POST['id_kolam'];
$title       = $_POST['title'];
$detail      = $_POST['detail'];
$harga       = $_POST['harga'];
$kapasitas   = $_POST['kapasitas'];


$temp = $_FILES['pic']['tmp_name'];
$name = rand(0, 9999) . $_FILES['pic']['name'];
$size = $_FILES['pic']['size'];
$type = $_FILES['pic']['type'];
$folder = "../../../uploads/";


if (isset($_POST['submit'])) {

    if (empty($temp)) {

        $update     = "UPDATE tm_kolam SET title='$title', detail='$detail', harga='$harga', kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
        $updatekolam    = mysqli_query($conn, $update) or die(mysqli_error($conn));
        if ($updatekolam) {
            $_SESSION["status"] = 'success';
            $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
        } else {
            $_SESSION["status"] = 'error';
            $_SESSION["pesan"] = 'Data Gagal Di Ubah';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
        }
    }
    //jika file/gamambar lbh besar 2mb
    elseif ($size < 2048000 and ($type == 'image/jpeg' or $type == 'image/png' or $type == "image/jpg")) {
        move_uploaded_file($temp, $folder . $name);
        $update     = "UPDATE tm_kolam SET title='$title', detail='$detail', pic='$name', harga='$harga', kapasitas='$kapasitas' WHERE id_kolam='$id_kolam'";
        $updatekolam    = mysqli_query($conn, $update) or die(mysqli_error($conn));

        if ($updatekolam) {
            $_SESSION["status"] = 'success';
            $_SESSION["pesan"] = 'Data Berhasil Di Ubah';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
        } else {
            $_SESSION["status"] = 'error';
            $_SESSION["pesan"] = 'Data Gagal Di Ubah';
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
        }
    } else {
        $_SESSION["status"] = 'warning';
        $_SESSION["pesan"] = 'Gagal Upload Gambar';
        echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL=../../../admin/admin.php?halaman=manajemen_kolam">';
    }
}
