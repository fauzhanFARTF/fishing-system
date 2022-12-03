<?php
session_start();

include '../index.php';

if (!isset($_SESSION['username'])) {

}

$level = $_SESSION["level"];

if ($level != "admin") {
    echo "<script>window.alert('Untuk mengakses, Anda harus Login Sebagai Admin');</script>";
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'fishing-system/admin/">';
    exit;

}
