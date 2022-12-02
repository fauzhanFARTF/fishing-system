<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

error_reporting(0);
// $conn = mysqli_connect("localhost", "root", "m4suk4j4h", "kontrakan");
include '../../../config/koneksi.php';
$dt1 = $_POST['dar'];
$dt2 = $_POST['ker'];
// echo $dt1;
// echo $dt2;
if (isset($_POST['cetak'])) {

    $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE tanggal BETWEEN '" . $dt1 . "' and '" . $dt2 . "'") or die(mysqli_error($conn));
}

if (empty($dt1) && empty($dt2)) {

    $query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN tm_kolam on tm_kolam.id_kolam = td_pesanan.id_kolam JOIN tm_user ON td_pesanan.nik = tm_user.nik WHERE td_pesanan.status = 'Transaksi Sudah Selesai' OR td_pesanan.status = 'Sudah Terkonfirmasi' ") or die(mysqli_error($conn));
}

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
    <link rel="icon" href="../../../admin/assets/img/fishing-logob.png" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../../../admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../../../admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="../../../admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    <style type="text/css" media="print">
        @page {
            size: auto;
            /* auto is the current printer page size */
            margin: 0mm;
            /* this affects the margin in the printer settings */
        }

        body {
            background-color: #FFFFFF;
            border: solid 1px black;
            margin: 0px;
            /* the margin on the content before printing */
        }
    </style>
</head>


<div class='col-md-12'>

    <div class='row-fluid'>
        <div class='col-md-8'>
            <table class=''>
                <tbody>
                    <tr>
                        <td>
                            <img src="..\..\..\admin\assets\img\fishing-logob.png" width="50" height="70" style="margin-top: 20px;">
                            <h4>PEMANCINGAN PERSADA</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Jl. Laos Perumahan Pasar Kemis, Kabupaten Tangerang
                        </td>
                    </tr>

                    <tr>
                        <td>Phone: 081210252638</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
    </div>
    <div class='col-md-8'>
        <div class='span12'>
            <table class='table table-bordered table-invoice-full'>
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
                    if (mysqli_num_rows($query) == 0) {
                        echo '<tr><td colspan="4" align="center">Tidak ada data!</td></tr>';
                    } else {
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
                                <td>Rp. <?php echo $data['harga'] ?></td>
                                <td><?php echo $data['qty'] ?></td>
                                <td>Rp. <?php echo number_format($data['total_harga']) ?></td>
                            </tr>
                    <?php
                            $no++;
                        }
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
                                <h4><span>GRAND TOTAL: Rp. <?php echo number_format($grand) ?></span></h4>
                                <br>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="../../../admin/assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="../../../admin/assets/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="../../../admin/assets/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="../../../admin/assets/js/custom.js"></script>


<script>
    window.print();
</script>