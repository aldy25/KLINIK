<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Pasien/updatedata', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <input style="display: none;" type="text" class="form-control" id="id" name="id"
                    value="<?= $id_pasien ?>">
                <div class="form-group row">
                    <label style=" color:black;" for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="nama_pasien" id="nama_pasien"
                            value="<?= $nama_pasien ?>" class="form-control">
                        <div class="invalid-feedback errornama_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="nik" class="col-sm-2 col-form-label">Nik</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="nik" id="nik" value="<?= $nik ?>"
                            class="form-control">
                        <div class="invalid-feedback errornik">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="jk_pasien" class="col-sm-2 col-form-label">Jenis Kelamin </label>
                    <div class="col-sm-8">
                        <select name="jk_pasien" id="jk_pasien" class="form-control">
                            <option style="color:black;" value="Laki-Laki"
                                <?php if ($jk_pasien == 'Laki-Laki') echo "selected"; ?>>Laki-Laki</option>
                            <option style="color:black;" value="Perempuan"
                                <?php if ($jk_pasien == 'Perempuan') echo "selected"; ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorjk_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="alamat_pasien" class="col-sm-2 col-form-label">Alamat Pasien
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="alamat_pasien" id="alamat_pasien"
                            class="form-control" value="<?= $alamat_pasien ?>">
                        <div class="invalid-feedback erroralamat_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="agama" class="col-sm-2 col-form-label">Agama
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="agama" id="agama" class="form-control"
                            value="<?= $agama ?>">
                        <div class="invalid-feedback erroragama">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style="color:black;" for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                            value="<?= $pekerjaan ?>">
                        <div class="invalid-feedback errorpekerjaan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="pendidikan" class="col-sm-2 col-form-label">Pendidikan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="pendidikan" id="pendidikan" class="form-control"
                            value="<?= $pendidikan ?>">
                        <div class="invalid-feedback errorpendidikan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style="color:black;" for="status_perkawinan" class="col-sm-2 col-form-label">Status
                        Perkawinan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="status_perkawinan" id="status_perkawinan"
                            class="form-control" value="<?= $status_perkawinan ?>">
                        <div class="invalid-feedback errorstatus_perkawinan">
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
                        if (response.error.nik) {
                            $('#nik').addClass('is-invalid');
                            $('.errornik').html(response.error.nik);
                        } else {
                            $('#nik').removeClass('is-invalid');
                            $('.errornik').html('');
                        }
                        if (response.error.nama_pasien) {
                            $('#nama_pasien').addClass('is-invalid');
                            $('.errornama_pasien').html(response.error.nama_pasien);
                        } else {
                            $('#nama_pasien').removeClass('is-invalid');
                            $('.errornama_pasien').html('');
                        }
                        if (response.error.jk_pasien) {
                            $('#jk_pasien').addClass('is-invalid');
                            $('.errorjk_pasien').html(response.error.jk_pasien);
                        } else {
                            $('#jk_pasien').removeClass('is-invalid');
                            $('.errorjk_pasien').html('');
                        }

                        if (response.error.alamat_pasien) {
                            $('#alamat_pasien').addClass('is-invalid');
                            $('.erroralamat_pasien').html(response.error.alamat_pasien);
                        } else {
                            $('#alamat_pasien').removeClass('is-invalid');
                            $('.erroralamat_pasien').html('');
                        }
                        if (response.error.agama) {
                            $('#agama').addClass('is-invalid');
                            $('.erroragama').html(response.error.agama);
                        } else {
                            $('#agama').removeClass('is-invalid');
                            $('.erroragama').html('');
                        }
                        if (response.error.pekerjaan) {
                            $('#pekerjaan').addClass('is-invalid');
                            $('.errorpekerjaan').html(response.error.pekerjaan);
                        } else {
                            $('#pekerjaan').removeClass('is-invalid');
                            $('.errorpekerjaan').html('');
                        }
                        if (response.error.pendidikan) {
                            $('#pendidikan').addClass('is-invalid');
                            $('.errorpendidikan').html(response.error.pendidikan);
                        } else {
                            $('#pendidikan').removeClass('is-invalid');
                            $('.errorpendidikan').html('');
                        }
                        if (response.error.status_perkawinan) {
                            $('#status_perkawinan').addClass('is-invalid');
                            $('.errorstatus_perkawinan').html(response.error
                                .status_perkawinan);
                        } else {
                            $('#status_perkawinan').removeClass('is-invalid');
                            $('.errorstatus_perkawinan').html('');
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