<?php
$file = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=tangerang&appid=2e5abf28d20c8a33b62a6cf8d21c34ff");
    // "https://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid={API key}"
$cuaca = json_decode($file, true); 
?>
<center>
    <h1>Cuaca di Tangerang Hari ini adalah </h1>
    <img src="http://openweathermap.org/img/wn/
        <?= $cuaca['weather'][0]['icon'] ?>@2x.png" alt="">
    <h2>
        <?php
        echo strtoupper($cuaca['weather'][0]['description']);
        ?>
    </h2>
    <h4>Kecepatan anggin : <?php
                            echo $cuaca['weather'][0]['wind']['speed'];
                            ?> meter/detik

    </h4>
</center>