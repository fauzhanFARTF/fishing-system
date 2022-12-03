<?php
error_reporting(0);
session_start();

include '../index.php';

if (!isset($_SESSION['username'])) {
    echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'fishing-system/">';
}

$level = $_SESSION["level"];

if ($level != "member") {
        session_destroy();
        echo "<script>window.alert('Silahkan Login Kembali');</script>";
        echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'fishing-system/">';
    } elseif ($level == "member") {
}
