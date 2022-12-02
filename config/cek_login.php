<?php
include '../index.php';
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

if ($level == 'Admin') {

    $login = mysqli_query($conn, "SELECT * FROM tm_user WHERE username='$username'");
    $cek = mysqli_num_rows($login);
    $data = mysqli_fetch_assoc($login);

        if ($cek > 0) {
            if(password_verify($password, $data["password"])) { 
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $data['level'];

                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Selamat datang '. $username;

                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/admin/admin.php?halaman=awal">';

            } else {
                echo "<script>window.alert('Username atau Password anda salah.');</script>";
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/admin/">';
            }
        } else {

            echo "<script>window.alert('Anda Belum Terdaftar.');</script>";
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/admin/">';

        }
    }

if ($level == 'member') {

    $login = mysqli_query($conn, "SELECT * FROM tm_user WHERE username='$username'");
    $cek = mysqli_num_rows($login);
    $data = mysqli_fetch_assoc($login);


        if ($cek > 0) {
            if(password_verify($password, $data["password"])) {  
                session_start();
                $_SESSION['nik'] = $data['nik'];
                $_SESSION['username'] = $username;
                $_SESSION['namalengkap'] = $data['nama_lengkap'];
                $_SESSION['alamat'] = $data['alamat'];
                $_SESSION['notelp'] = $data['no_telp'];
                $_SESSION['level'] = $data['level'];

                $_SESSION["status"] = 'success';
                $_SESSION["pesan"] = 'Selamat datang '. $username .' !';
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/page/member.php">';

            }
            else {
                echo "<script>window.alert('Username atau Password anda salah.');</script>";
                echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/">';
            }
        } else {
            echo "<script>window.alert('Anda Belum Terdaftar');</script>";
            echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'pemancingan/">';
        }
}

