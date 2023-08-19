<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Akun/updatedata', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input style="display: none;" type="text" class="form-control" id="id" name="id"
                    value="<?= $id_user ?>">
                <div class="form-group row">
                    <label style=" color:black;" for="level" class="col-sm-2 col-form-label">Level Akun </label>
                    <div class="col-sm-8">
                        <select name="level" id="level" class="form-control">
                            <option style="color:black;" value="Web Master"
                                <?php if ($level == 'Web Master') echo "selected"; ?>>Web Master</option>
                            <option style="color:black;" value="Dokter"
                                <?php if ($level == 'Dokter') echo "selected"; ?>>Dokter</option>
                            <option style="color:black;" value="Administrator"
                                <?php if ($level == 'Administrator') echo "selected"; ?>>Administrator</option>
                            <option style="color:black;" value="Apoteker"
                                <?php if ($level == 'Apoteker') echo "selected"; ?>>Apoteker</option>
                        </select>
                        <div class="invalid-feedback errorlevel">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="role1" class="col-sm-2 col-form-label">Role 1</label>
                    <div class="col-sm-8">
                        <select name="role1" id="role1" class="form-control">
                            <option style="color:black;" value="" <?php if ($role1 == '') echo "selected"; ?>>Kosongkan
                                Role</option>
                            <option style="color:black;" value="Dokter"
                                <?php if ($role1 == 'Dokter') echo "selected"; ?>>Dokter</option>
                            <option style="color:black;" value="Administrator"
                                <?php if ($role1 == 'Administrator') echo "selected"; ?>>Administrator</option>
                            <option style="color:black;" value="Apoteker"
                                <?php if ($role1 == 'Apoteker') echo "selected"; ?>>Apoteker</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="role2" class="col-sm-2 col-form-label">Role 2</label>
                    <div class="col-sm-8">
                        <select name="role2" id="role2" class="form-control">
                            <option style="color:black;" value="" <?php if ($role2 == '') echo "selected"; ?>>Kosongkan
                                Role</option>
                            <option style="color:black;" value="Dokter"
                                <?php if ($role2 == 'Dokter') echo "selected"; ?>>Dokter</option>
                            <option style="color:black;" value="Administrator"
                                <?php if ($role2 == 'Administrator') echo "selected"; ?>>Administrator</option>
                            <option style="color:black;" value="Apoteker"
                                <?php if ($role2 == 'Apoteker') echo "selected"; ?>>Apoteker</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="nama" id="nama" value="<?= $nama_user ?>"
                            class="form-control">
                        <div class="invalid-feedback errornama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="status" class="col-sm-2 col-form-label">Status </label>
                    <div class="col-sm-8">
                        <select name="status" id="stts" class="form-control">
                            <option style="color:black;" value="on" <?php if ($level == 'on') echo "selected"; ?>>On
                            </option>
                            <option style="color:black;" value="off" <?php if ($level == 'off') echo "selected"; ?>>Off
                            </option>
                        </select>
                        <div class="invalid-feedback errorstatus">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="username" class="col-sm-2 col-form-label">Username </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="username" id="username" value="<?= $username ?>"
                            class="form-control">
                        <div class="invalid-feedback errorusername">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style="color:black;" for="password" class="col-sm-2 col-form-label">Password </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="password" name="password" id="password" class="form-control"
                            minlength="8">
                        <div class="invalid-feedback errorpassword">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="rePassword" class="col-sm-2 col-form-label">Ulangi
                        Password</label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="password" class="form-control" id="repassword"
                            name="repassword" minlength="8">
                        <div class="invalid-feedback errorrepassword">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                </div>
                <?= form_close() ?>
            </div>

        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.formedit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', );
                    $('.btnsimpan').html('Update');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.repassword) {
                            $('#repassword').addClass('is-invalid');
                            $('.errorrepassword').html(response.error.repassword);
                        } else {
                            $('#repassword').removeClass('is-invalid');
                            $('.errorrepassword').html('');
                        }


                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses

                        })
                        $('#modaledit').modal('hide');
                        dataAdmin();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });
    });
    </script>