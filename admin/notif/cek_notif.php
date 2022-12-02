<?php 
// $conn = mysqli_connect("localhost", "root", "m4suk4j4h", "dbpemancingan");
    include '../../config/koneksi.php';
	$q = mysqli_query($conn, "SELECT count(id_konfirm) as jml FROM konfirmasi WHERE status='0' ");
	if(mysqli_num_rows($q) > 0) {
		$row = mysqli_fetch_assoc($q);
                echo $row['jml'];
	}
