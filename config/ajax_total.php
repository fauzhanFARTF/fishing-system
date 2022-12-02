<?php

error_reporting(0);
include 'koneksi.php';

$id_kolam = $_GET["id_kolam"];
$qty = $_GET["jml_org"];

$query = "SELECT * FROM tm_kolam WHERE id_kolam = '$id_kolam'";
$sql = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);

$total = $row["harga"] * $qty;

echo $total;


	/* include "config/koneksi.php";

	$id_berangkat = $_GET["id_berangkat"];
	$query = "SELECT * FROM bus WHERE id_berangkat = '$id_berangkat'";
	$sql = mysqli_query($conn,$query)or die(mysqli_error($conn));
	
	while ($row = mysqli_fetch_array($sql)) { ?>
		<option value="<?php echo $row['id_bus']; ?>"><?php echo $row["kelas"] ?> | <?php echo $row["harga"]; ?></option>
	<?php
	}
	?> */
