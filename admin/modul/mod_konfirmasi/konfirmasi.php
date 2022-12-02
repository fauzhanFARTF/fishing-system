<?php

include '../../../config/koneksi.php';

$id_konfirm    = $_GET['id_konfirm'];
$query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_konfirmasi ON td_konfirmasi.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_user ON td_pesanan.nik = tm_user.nik  JOIN tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE td_konfirmasi.id_konfirm = '$id_konfirm'") or die(mysqli_error($conn));
$data   = mysqli_fetch_array($query);

?>


<div class="row">
    <div class="col-md-12">
        <center>
            <h2>Detail Pembayaran</h2>
        </center>
        <div class="col-md-10">
            <br>
            <br>
            <h5><b>Kode Transaksi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['kd_transaksi']; ?></b></h5>
            <h5><b>Nama Pemesan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $data['nama_lengkap']; ?></b></h5>
            <form action="..\admin\modul\mod_konfirmasi\update_konfirmasi.php" method="POST">
                <input type="hidden" name="id_konfirm" value="<?php echo $data['id_konfirm']; ?>">
                <table class="table table-striped-bordered">
                    <tr>
                        <input type="hidden" name="kd_transaksi" value="<?= $data['kd_transaksi'] ?>">
                    </tr>
                    <tr>
                        <td width="200">Jenis Kolam</td>
                        <td width="50">:</td>
                        <td><?php echo $data['title']; ?></td>
                    </tr>
                    <tr>
                        <td width="200">Alamat</td>
                        <td width="50">:</td>
                        <td><?php echo $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td width="200">Tanggal Pemesanan</td>
                        <td width="50">:</td>
                        <td><?php echo $data['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <td width="200">Quantity</td>
                        <td width="50">:</td>
                        <td><?php echo $data['qty']; ?></td>
                    </tr>
                    <tr>
                        <td width="200">Total Harga</td>
                        <td width="50">:</td>
                        <td><?php echo $data['total_harga']; ?></td>
                    </tr>
                    <tr>
                        <td width="200">Bukti Pembayaran</td>
                        <td width="50">:</td>
                        <td><img src="../uploads/<?php echo $data['bukti']; ?>" width="450px" height="400px"></td>
                    </tr>
                    <tr>
                        <td width="200"></td>
                        <td><a href="admin.php?halaman=manajemen_konfirmasi" class="btn btn-warning">Batal</a></td>
                        <?php 
                            echo '<td><a href=..\admin\modul\mod_konfirmasi\cetak_tiket.php?id_konfirm=' . $id_konfirm . ' class="btn btn-info"><span class="glyphicon glyphicon-print">Cetak</span></a></td>' ?>
                        <?php 
                            if ($data['status'] == "Belum Terkonfirmasi")
                                echo "<td><button type='submit' class='btn btn-danger'>Konfirmasi</button></td>";
                            elseif ($data['status'] == "Sudah Terkonfirmasi")
                                echo "<td><button type='submit' class='btn btn-danger' disabled>Konfirmasi</button></td>";
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

