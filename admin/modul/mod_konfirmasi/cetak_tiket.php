<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
// error_reporting(0);
include '../../../config/koneksi.php';

$id_konfirm = $_GET['id_konfirm'];
// $kd_transaksi = $_GET['kd_transaksi'];
$query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_konfirmasi ON td_konfirmasi.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_user ON td_pesanan.nik = tm_user.nik JOIN tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE td_konfirmasi.id_konfirm = '$id_konfirm'") or die(mysqli_error($conn));
$list = mysqli_fetch_array($query);
$id_kol = $list['id_kolam'];

?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Free Bootstrap Admin Template : Binary Admin</title>
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


<div class='container-fluid'>

    <div class='row-fluid'>
        <div class='col-md-8'>
            <!-- <img src="..\..\..\admin\assets\img\fishing-logob.png" width="50" height="70" style="margin-top: 20px;"> -->
            <table class=''>
                <h4 style="padding-top: 1px;">PEMANCINGAN PERSADA</h4>
                <tbody>

                </tbody>
            </table>
        </div>
        <br>
        <div class='col-sm-8'>
            <table class='table table-bordered table-invoice'>
                <tbody>
                    

                    <tr>
                        <td class='width30'>Kode Transaksi:</td>
                        <td class='width70'><strong><?php echo $list['kd_transaksi']; ?></strong></td>

                    </tr>
                    <tr>
                        <td>Status Bayar</td>
                        <td>
                            <?php
                            if ($list['status'] == "Sudah Terkonfirmasi") {
                                echo "<label class='label label-success'>Lunas</label>";
                            } else {
                                echo "<label class='label label-warning'>Belum Lunas</label>";
                            }
                            ?>

                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Pemesanan :</td>
                        <td><strong><?php echo date('d-m-Y', strtotime($list['tanggal'])); ?></strong></td>
                    </tr>
                    <tr>
                        <td>Atas Nama :</td>
                        <td>
                            <?php echo $list['nama_lengkap']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat :</td>
                        <td>
                            <?php echo $list['alamat']; ?>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
    <div class='row-fluid'>
        <div class='span12'>
            <table class='table table-bordered table-invoice-full'>
                <thead>
                    <tr>
                        <th>Tipe Kolam</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $SQL = mysqli_query($conn, "SELECT * FROM tm_kolam  WHERE id_kolam = '$id_kol'");
                    while ($r = mysqli_fetch_array($SQL)) {
                        $harga = 'Rp. ' . number_format($r['harga']);
                        $qty = $list['qty'];
                        $subtotal = 'Rp. ' . number_format($list['total_harga']);
                        $title = $r['title'];
                        echo "<tr>
                        <td>$title</td>
                        <td>$harga</td>
                        <td>$qty</td>
                        <td>$subtotal</td>
                    </tr>";
                    } ?>
                </tbody>
            </table>
            <table class='table table-bordered table-invoice-full'>
                <tbody>
                    <tr>
                        <td class='msg-invoice' width='85%'>
                            <h4>INVOICE PEMESANAN PEMANCINGAN PERSADA </h4>
                            <?php $bank = mysqli_query($conn, "SELECT * FROM tm_rekening");
                            $bnk = mysqli_fetch_array($bank);
                            ?>
                            <a href='#' title='Kasir'>Kasir</a> | <a href='#' title=''><?php echo "$bnk[bank] - ($bnk[no_rek]) $bnk[atas_nama]" ?> </a>
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