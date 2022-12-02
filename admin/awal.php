<?php
include "../config/session_admin.php";

echo "<h5>Welcome " . $_SESSION['username'] . " , Loveeeeeeeee to see you back. </h5>";


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


<div class="col-md-12" style="margin-top: 20px;">
    <div class="main-temp-back">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12 pt-10">
                    <div class="col-xs-12"><label for="cuaca">Cuaca : </label> <span>Tangerang</span> </div>
                </div><br><br>
                <img src="http://openweathermap.org/img/wn/<?= $cuaca['weather'][0]['icon'] ?>@2x.png" alt="">
                <h2 color="white">
                    <?php
                    echo strtoupper($cuaca['weather'][0]['description']);
                    ?>
                </h2>
                <br>
                <div class="col-md-12 pt-10">
                    <div class="col-xs-12"><label for="cuaca">Suhu Rata-Rata : </label> <span><?= $cuaca ['main']['temp'] -273.15?>°C</span> </div>
                </div>
                <div class="col-md-12">
                    <div class="col-xs-12"><label for="cuaca">Kelembaban : </label> <?= $cuaca['main']['humidity'] ?> %</div>
                </div>
                <div class="col-md-12">
                    <div class="col-xs-12"><label for="cuaca">Kecepatan Angin : </label> <?= $cuaca['wind']['speed'] ?> Meter/Detik</div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <br>
        <div class="col-md-3 col-sm-12 col-xs-12"><a href="?halaman=manajemen_pesanan">
                <div class="panel panel-primary text-center no-boder bg-color-green" >
                    <div class="panel-body">
                        <i class="fa fa-envelope-o fa-5x"></i>
                        <h3></h3>
                    </div>
                    <div class="panel-footer back-footer-green">
                        Pesanan

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12"><a href="?halaman=manajemen_konfirmasi">
                <div class="panel panel-primary text-center no-boder bg-color-red">
                    <div class="panel-body">
                        <i class="fa fa-check-circle fa-5x"></i>
                        <h3></h3>
                    </div>
                    <div class="panel-footer back-footer-red">
                        Konfirmasi Pesanan Pelanggan

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12"><a href="?halaman=manajemen_laporan">
                <div class="panel panel-primary text-center no-boder bg-color-orange">
                    <div class="panel-body">
                        <i class="fa fa-file fa-5x"></i>
                        <h3></h3>
                    </div>
                    <div class="panel-footer back-footer-orange">
                        Report/Laporan

                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12"><a href="?halaman=manajemen_user">
                <div class="panel panel-primary text-center no-boder bg-color-blue">
                    <div class="panel-body">
                        <i class="fa fa-user fa-5x"></i>
                        <h3></h3>
                    </div>
                    <div class="panel-footer back-footer-blue">
                        Users

                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="lg-8 col-ml-12" style="margin-left: 400px;">
    <div class="col-md-4 col-sm-16 col-xs-16"><a href="?halaman=manajemen_kolam">
            <div class="panel panel-primary text-center no-boder bg-color-black">
                <div class="panel-body">
                    <i class="fa fa-external-link fa-5x"></i>
                    <h3></h3>
                </div>
                <div class="panel-footer back-footer-black">
                    Kolam

                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-16 col-xs-16">
        <a href="?halaman=manajemen_rekening">
            <div class="panel panel-primary text-center no-boder bg-color-pink">
                <div class="panel-body">
                    <i class="fa fa-credit-card fa-5x"></i>
                    <h3></h3>
                </div>
                <div class="panel-footer back-footer-pink">
                    Rekening

                </div>
            </div>
        </a>
    </div>
</div>

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