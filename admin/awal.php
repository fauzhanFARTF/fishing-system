<?php
include "../config/session_admin.php";

echo "<h5>Welcome " . $_SESSION['username'] . " , </h5>";


include '../config/koneksi.php';

$file2 = file_get_contents("https://iotcampus.net/bmkg/?menu=cuaca&wilayah=banten");
$cuaca2 = json_decode($file, true);

foreach ($cuaca2 as $cuak => $value) {
    $data[] = $value;
}
// // json_encode($data[15]);
$file = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=tangerang&appid=2e5abf28d20c8a33b62a6cf8d21c34ff");
    // "https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid={API key}"
$cuaca = json_decode($file, true); 

?>


<img src="../admin/assets/img/mancing.jpeg" class=" img-responsive" />


<script src="../admin/assets/js/sweetalert2.min.js"></script>

<?php
session_start();
if (isset($_SESSION['pesan'])) { ?>
    <script>
        Swal.fire({
            title: "Info",
            text: "<?php echo $_SESSION['pesan']; ?>",
            type: "<?php echo $_SESSION['status']; ?>",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php unset($_SESSION['pesan']);
} ?>