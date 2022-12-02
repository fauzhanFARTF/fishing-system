<?php

include '../../../config/koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN tm_user ON td_pesanan.nik = tm_user.nik JOIN tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE td_pesanan.status ='Ditolak' ORDER BY td_pesanan.kd_transaksi DESC") or die(mysqli_error($conn));

?>


<div class="row">
    <div class="col-md-12">
        <!--   Kitchen Sink -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Manajemen Pesanan Kolam Pemancingan yang Ditolak
            </div>
            <hr>
            <!-- &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary tombolTambah" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Tambah</button> -->
            <br>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hove" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Transaksi</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Kolam</th>
                                <th>Nama Pemesan</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = mysqli_fetch_array($query)) {
                                echo '<tr>';
                                echo '<td>' . $no . '</td>';
                                echo '<td>' . $data['kd_transaksi'] . '</td>';
                                echo '<td>' . date('d-m-Y', strtotime($data['tanggal'])) . '</td>';
                                echo '<td>' . $data['title'] . '</td>';
                                echo '<td>' . $data['nama_lengkap'] . '</td>';;
                                echo '<td>' . $data['qty'] . '</td>';
                                echo '<td>' .  'Rp. ' . number_format($data['total_harga']) . '</td>';
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End  Kitchen Sink -->
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" align="center">Tambahkan Pesanan</h4>
            </div>
            <div class="modal-body">
                <?php
                $uery = mysqli_query($conn, "SELECT * FROM tm_kolam");
                $uery2 = mysqli_query($conn, "SELECT * FROM tm_user");
                // $kd_kol = mysqli_fetch_array($uery);
                // $kd_trans = $kd_kol['kd_kolam'] .  rand(0, 9999);
                ?>
                <form action="..\admin\modul\mod_pesanan\add_pesanan.php" class="form-horizontal" method="POST" onsubmit="return validasi_input(this)">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Pilih Kolam :</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="id_kolam" id="kolam">
                                <option value="pilih">--Pilih Kolam--</option>
                                <?php while ($kol = mysqli_fetch_array($uery)) { ?>
                                    <option value="<?php echo $kol['id_kolam'] ?>"><?php echo $kol["title"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-4">Kode Transaksi :</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="kdtransaksi" name="kd_transaksi" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Masukan NIK :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="nik" name="nik" >
                        </div>
                    </div>
                    <div class="form-group">
                            <label class="control-label col-sm-4">Nama Lengkap :</label>
                        <div class="col-sm-6">
                            <input class="form-control" id="namaLengkap" name="nama_lengkap" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Tanggal :</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Quantity :</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="jml_org" id="jml_org" required>
                                <option>--Jumlah unit yang disewa--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Harga Total :</label>
                        <div class="col-sm-6">
                            <input type="tel" class="form-control" name="total_harga" id="total" placeholder="Harga">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-6" align="right">
                            <button class="btn btn-danger" onblclick="return confirm('apakah data sudah benar')">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_delete">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Anda yakin akan menghapus data ini.. ?</h4>
            </div>

            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-sm" id="delete_link">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- <script type="text/javascript" src="..\admin\assets\js\jquery-3.6.0.min.js"></script> -->
<script src="../admin/assets/js/jquery-1.10.2.js"></script>
<script src="../admin/assets/js/sweetalert2.min.js"></script>

<script type="text/javascript">
    function confirm_modal(delete_url) {
        $('#modal_delete').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>

<script type="text/javascript">
    $("#kolam").change(function() {
        var id_kolam = $("#kolam").val();
        console.log(id_kolam);
        $.ajax({
            url: "../config/ajax_kode.php?id_kolam=" + id_kolam,
            success: function(result) {
                console.log(result);
                $("#kdtransaksi").val(result);
            }
        });
    });
    $("#nik").change(function() {
        var nik = $("#nik").val();
        console.log(nik);
        $.ajax({
            url: "../config/ajax_kode2.php?nik=" + nik,
            success: function(result) {
                console.log(result);
                $("#namaLengkap").val(result);
            }
        });
    });

    $("#jml_org").change(function() {
        var id_kolam = $("#kolam").val();
        var qty = $("#jml_org").val();
        console.log(qty);
        $.ajax({
            url: "../config/ajax_total.php?id_kolam=" + id_kolam + "&jml_org=" + qty,
            success: function(result) {
                console.log(result);
                $("#total").val(result);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
</script>

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

<!-- <script type="text/javascript">
    $(function() {
        function notif() {
            $('#notif').html('');
            $.ajax({
                url: '../admin/notif/cek_notif.php',
                success: function(data) {
                    if (data.length > 0) {
                        $('#notif').html(data);
                    }
                    console.log(notif);
                }
            });
        }

        // Update every 5 seconds.
        setInterval(notif, 5000);

    });
</script> -->

<!-- <script type="text/javascript">
    function validasi_input(form) {
        if (form.id_kolam.value == "pilih") {
            alert("Anda belum memilih kolam!");
            return (false);
        }
        return (true);
    }
</script> -->