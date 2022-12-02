<?php

include '../../../config/koneksi.php';

?>


<div class="row">
    <div class="col-md-12">
        <!--   Kitchen Sink -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Manajemen Konfirmasi
            </div>
            <hr>
            &nbsp;&nbsp;&nbsp;
            <br>

            <form action="" method="post">
                <div class='pull-right'>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Periode :</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="dari" name="dari">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Sampai :</label>
                        <div class="col-md-12">
                            <input type="date" class="form-control" id="ke" name="ke">
                        </div>
                    </div>
                    <div class='pull-right'>
                        &nbsp;
                        <div class="form-group">
                            <div class="col-md-12">
                                <input class="btn btn-primary btn-sm" type="submit" name="cari" value="Cari">
                            </div>
                        </div>
                        &nbsp;
                    </div>

                </div>
            </form>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Kode Transaksi</th>
                                <th>User</th>
                                <th>Alamat</th>
                                <th>Jenis Kolam</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            // if (isset($_POST["tampilkan"])) {
                            $dt1 = $_POST["dari"];
                            $dt2 = $_POST["ke"];



                            if (isset($_POST['cari'])) {

                                // $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_transaksi_selesai ON td_transaksi_selesai.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE tanggal BETWEEN '" . $dt1 . "' and '" . $dt2 . "'") or die(mysqli_error($conn));
                                 $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE tanggal BETWEEN '" . $dt1 . "' and '" . $dt2 . "'") or die(mysqli_error($conn));                               
                            } else {

                                // $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_transaksi_selesai ON td_transaksi_selesai.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE td_pesanan.status = 'Transaksi Sudah Selesai' OR td_pesanan.status = 'Sudah Terkonfirmasi' ") or die(mysqli_error($conn));
                                
                                 $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE td_pesanan.status = 'Transaksi Sudah Selesai' OR td_pesanan.status = 'Sudah Terkonfirmasi' ") or die(mysqli_error($conn));                               
                            }
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                $grand += $data['total_harga'];
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($data['tanggal'])) ?></td>
                                    <td><?php echo $data['kd_transaksi'] ?></td>
                                    <td><?php echo $data['nama_lengkap'] ?></td>
                                    <td><?php echo $data['alamat'] ?></td>
                                    <td><?php echo $data['title'] ?></td>
                                    <td>Rp. <?php echo number_format($data['harga']) ?></td>
                                    <td><?php echo $data['qty'] ?></td>
                                    <td>Rp. <?php echo number_format($data['total_harga']) ?></td>
                                <?php
                                $no++;
                            }

                                ?>
                        </tbody>
                    </table>

                    <table class='table table-bordered table-invoice-full'>
                        <tbody>
                            <tr>
                                <td class='msg-invoice' width='85%'>
                                    <h4>Laporan Pemesanan Tiket PEMANCINGAN PERSADA </h4>
                                    <?php $bank = mysqli_query($conn, "SELECT * FROM tm_rekening");
                                    $bnk = mysqli_fetch_array($bank);
                                    ?>
                                    <a href='#' title='Kasir'>Kasir</a> | <a href='#' title=''><?php echo "$bnk[bank] - ($bnk[no_rek]) $bnk[atas_nama]" ?> </a>
                                </td>
                                <td>
                                    <div class='pull-right'>
                                        <h4><span>GRAND TOTAL : Rp.<?php echo number_format($grand) ?></span></h4>
                                        <br>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form action="..\admin\modul\mod_laporan\cetak_laporan.php" method="post">
                    <input type="hidden" name="dar" value="<?php echo $dt1; ?>">
                    <input type="hidden" name="ker" value="<?php echo $dt2; ?>">

                    <input type="submit" name="cetak" value="Cetak" class="btn btn-success bt-sm">
                </form>
                <!-- <a href="..\admin\modul\mod_laporan\cetak_laporan.php"><input type='button' class='btn btn-success' id="cetak" name="cetak">Cetak<span class='glyphicon glyphicon-print'></span></a> -->
            </div>
        </div>
    </div>
</div>
