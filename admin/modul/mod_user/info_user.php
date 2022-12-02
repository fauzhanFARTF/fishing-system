<?php

include '../../../config/koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM tm_user ORDER BY timestamp DESC") or die(mysqli_error($conn));

?>

<div class="row">
    <div class="col-md-12">
        <!--   Kitchen Sink -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Manajemen User
            </div>
            <hr>
            &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Tambah</button>
            <br>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No.telp</th>
                                <th>Level</th>
                                <th colspan="2">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (mysqli_num_rows($query) == 0) {
                                echo '<tr><td colspan="4" align="center">Tidak ada data!</td></tr>';
                            } else {
                                $no = 1;
                                while ($data = mysqli_fetch_array($query)) {
                                    echo '<tr>';
                                    echo '<td>' . $no . '</td>';
                                    echo '<td>' . $data['nik'] . '</td>';
                                    echo '<td>' . $data['nama_lengkap'] . '</td>';
                                    echo '<td>' . $data['username'] . '</td>';
                                    echo '<td>' . $data['email'] . '</td>';
                                    echo '<td>' . $data['alamat'] . '</td>';
                                    echo '<td>' . $data['no_telp'] . '</td>';
                                    echo '<td>' . $data['level'] . '</td>';
                                    echo '<td><a href=admin.php?halaman=edit_user&&nik=' . $data['nik'] . '><span class="glyphicon glyphicon-edit"></a></td>'; ?>
                                    <td><a href="#" onclick="confirm_modal('../admin/modul/mod_user/delete_user.php?nik= <?= $data['nik'] ?> ');"><span class="glyphicon glyphicon-trash"></span></a></td>
                            <?php
                                    echo '</tr>';
                                    $no++;
                                }
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
                <h4 class="modal-title" align="center">Tambahkan User</h4>
            </div>
            <div class="modal-body">
                <form action="..\admin\modul\mod_user\add_user.php" class="form-horizontal" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-4">NIK :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nik" placeholder="nik">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Username :</label>
                        <div class="col-sm-6">
                            <input type="username" class="form-control" name="username" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Password :</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama Lengkap :</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama_lengkap" placeholder="namalengkap">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Email :</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Alamat :</label>
                        <div class="col-sm-6">
                            <textarea rows="3" type="text" class="form-control" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">No.Telp :</label>
                        <div class="col-sm-6">
                            <input type="tel" class="form-control" name="no_telp" placeholder="No.telp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Level :</label>
                        <div class="col-sm-6">
                            <select type="level" class="form-control" name="level">
                                <option>admin</option>
                                <option>member</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-6" align="right">
                            <button class="btn btn-danger">Simpan</button>
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

<script src="../admin/assets/js/jquery-1.10.2.js"></script>
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

<script type="text/javascript">
    function confirm_modal(delete_url) {
        $('#modal_delete').modal('show', {
            backdrop: 'static'
        });
        document.getElementById('delete_link').setAttribute('href', delete_url);
    }
</script>