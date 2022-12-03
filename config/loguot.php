<?php
error_reporting(0);

session_start();
session_destroy();

include "../index.php";
echo '<META HTTP-EQUIV="REFRESH" CONTENT = "0; URL='.$domain.'fishing-system/admin">';

