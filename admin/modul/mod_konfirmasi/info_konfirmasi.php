<?php
include '../../../config/koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM td_pesanan JOIN td_konfirmasi ON td_konfirmasi.kd_transaksi = td_pesanan.kd_transaksi JOIN tm_user ON td_pesanan.nik = tm_user.nik JOIN tm_kolam ON td_pesanan.id_kolam = tm_kolam.id_kolam WHERE td_konfirmasi.sts='Bukti Pembayaran Masuk' OR td_konfirmasi.sts = 'Bukti Pembayaran Diterima' order by td_pesanan.status asc") or die(mysqli_error($conn));
?>

<div class="row">
    <div class="col-md-12">
        <!--   Kitchen Sink -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Manajemen Konfirmasi
            </div>
            <hr>
            &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
            <br>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Transaksi</th>
                                <th>Nama</th>
                                <th>Jenis Kolam</th>
                                <th>Quantity</th>
                                <th>Total Harga</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                                <th>
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no =1;
                                while ($data = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $data['kd_transaksi']; ?></td>
                                        <td><?php echo $data['nama_lengkap']; ?></td>
                                        <td><?php echo $data['title']; ?></td>
                                        <td><?php echo $data['qty']; ?></td>
                                        <td><?php echo 'Rp. ' . number_format($data['total_harga']); ?></td>
                                        <td><img src="../uploads/<?php echo $data['bukti']; ?>" width="120" height="155"></td>
                                        <td><?php if ($data['status'] == "Belum Terkonfirmasi") echo "<label class='label label-warning'>Belum Di Konfirmasi</label>";
                                            elseif ($data['status'] == "Sudah Terkonfirmasi") echo "<label class='label label-success'>Sudah Di Konfirmasi</label>";
                                            ?>
                                            <?php
                                            echo '
                                            <td>
                                                <form action="">
                                                    <a href=admin.php?halaman=konfirmasi&id_konfirm=' . $data['id_konfirm'] . '>
                                                        <span class="glyphicon glyphicon-edit" style="margin-right: 10px; margin-left:70px;"></a>';
                                                    ?>
                                                    <a href="#" onclick="confirm_modal('../admin/modul/mod_konfirmasi/release_konfirmasi.php?id_konfirm=<?= $data['id_konfirm']; ?> ');">
                                                        <span class="glyphicon glyphicon-repeat" style="margin-left:10px;"></a>
                                                    <a href="#" onclick="confirm_modal2('../admin/modul/mod_konfirmasi/delete_tidakadakonfirmasi.php?id_konfirm=<?= $data['id_konfirm']; ?>');">
                                                        <span style="margin-left:10px;" class="glyphicon glyphicon-trash"></span></a> 
                                                </form>
  

                                            </td>
                                <?php
                                    echo "</tr>";
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
                <h4 class="modal-title" align="center">Tambahkan Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="..\admin\modul\mod_konfirmasi\add_konfirmasi.php" class="form-horizontal" method="POST">
                    <input type="hidden" class="form-control" name="id_konfirmasi" id="id_konfirmasi"required>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Kode Transaksi :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="kd_transaksi" id="kd_transaksi" placeholder="Kode Transaksi" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="user" id="user" readonly autocomplete="off" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Alamat :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="alamat" id="alamat" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Kolam Tipe :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="kolam" id="qolam" readonly required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Quantity :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="qty" id="qty" readonly>
                            </input>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Total Harga :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="total_harga" id="tot_har" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="bukti">Bukti :</label>
                        <div class="col-sm-6">
                            <p3>Pilih Gambar :</p3><br><br>
                            <input type="file" class="form-control" name="bukti" id="bukti">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="rekening"><b>No Rekening :</b></label>
                        <div class="col-sm-8">
                            <?php  $rekening = mysqli_query($conn, "SELECT * FROM tm_rekening");?>
                            <select class="form-control" name="no_rek" id="no_rek" required>
                                <?php while($rek= mysqli_fetch_array($rekening)){ ?>
                                    <option value= <?php echo $rek['no_rek'];?> > <?php echo $rek['bank']. " " . $rek['no_rek']." ". $rek['atas_nama']; ?></option>
                                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-6" align="right">
                            <button class="btn btn-danger" name="submit">Simpan</button>
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
                <h4 class="modal-title" style="text-align:center;">Anda akan merelease unit kolam kembali ?</h4>
            </div>
            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-sm" id="delete_link">Release</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_delete2">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Apakah Anda Ingin Menghapus Konfirmasi ini dan mengembalikan ke Proses Pemesanan ?</h4>
            </div>

            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Cancel</button>
                <a href="#" class="btn btn-danger btn-sm" id="delete_link2">Hapus</a>
            </div>
        </div>
    </div>
</div>

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
    function confirm_modal2(delete_url) {
        $('#modal_delete2').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link2').setAttribute('href', delete_url);
    }
</script>

<script type="text/javascript">
    $('#kd_transaksi').change(function() {
        var kdkolam = $('#kd_transaksi').val();
        console.log(kdkolam);
        $.ajax({
            url: "../config/ajx_quan.php?kd_transaksi=" + kdkolam,
            success: function(result) {
                // console.log(result);
                $.each(JSON.parse(result), function(i, item) {
                    console.log(item.id_kolam)
                    $("#user").val(item.nama_lengkap);
                    $("#alamat").val(item.alamat);
                    $("#tot_har").val(rupiah(item.total_harga));
                    $("#qolam").val(item.title);
                    $("#qty").val(item.qty);
                    $("#id_konfirmasi").val(item.id_konfirm);
                });
            }
        });
    });
    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }
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
            showConfirmButton: true,
            timer: 5000
        });
    </script>
<?php unset($_SESSION['pesan']);
} ?>