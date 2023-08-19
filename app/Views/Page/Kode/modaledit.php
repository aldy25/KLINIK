<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Pengkodean Rekam Medis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Kode/updatedata', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_rm ?>" style="color:black;" type="text" name="id" id="id"
                            class="form-control">
                        <div class="invalid-feedback errorid">
                        </div>
                    </div>
                </div>
                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id_pasien" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_pasien ?>" style="color:black;" type="text" name="id_pasien"
                            id="id_pasien" class="form-control">
                        <div class="invalid-feedback errorid_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_pasien ?>" disabled style="color:black;" type="text" name="nama_pasien"
                            id="nama_pasien" class="form-control">
                        <div class="invalid-feedback errornama_pasien">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="layanan" class="col-sm-2 col-form-label">Layanan</label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_layanan ?>" disabled style="color:black;" type="text" name="layanan"
                            id="layanan" class="form-control">
                        <div class="invalid-feedback errorlayanan">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="icd9" class="col-sm-2 col-form-label">ICD9 / Tindakan </label>
                    <div class="col-sm-8">
                        <select required="" name="icd9" id="icd9" class="form-control">
                            <option style="color:black;" value="">---------------PILIH---------------</option>
                            <?php
                            $db   = \Config\Database::connect();
                            $dataicd9 = $db->query("SELECT * from tbl_icd9");
                            $data = $dataicd9->getResult();
                            foreach ($data as $row) {
                            ?>
                            <option style="color:black;" value="<?= $row->id_icd9 ?>">
                                <?= $row->kode ?> | <?= $row->deskripsi ?></option>

                            <?php } ?>
                        </select>

                        <div class="invalid-feedback erroricd9">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="icd10" class="col-sm-2 col-form-label">ICD10 / Diagnosa
                    </label>
                    <div class="col-sm-8">

                        <select required="" name="icd10" id="icd10" class="form-control">
                            <option style="color:black;" value="">---------------PILIH---------------</option>
                            <?php
                            $db   = \Config\Database::connect();
                            $dataicd10 = $db->query("SELECT * from tbl_icd10");
                            $data = $dataicd10->getResult();
                            foreach ($data as $row) {
                            ?>
                            <option style="color:black;" value="<?= $row->id_icd10 ?>">
                                <?= $row->kode ?> | <?= $row->diagnosa ?></option>

                            <?php } ?>
                        </select>
                        <div class="invalid-feedback erroricd10">
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
                        if (response.error.icd9) {
                            $('#icd9').addClass('is-invalid');
                            $('.erroricd9').html(response.error.icd9);
                        } else {
                            $('#icd9').removeClass('is-invalid');
                            $('.erroricd9').html('');
                        }
                        if (response.error.icd10) {
                            $('#icd10').addClass('is-invalid');
                            $('.erroricd10').html(response.error.icd10);
                        } else {
                            $('#icd10').removeClass('is-invalid');
                            $('.erroricd10').html('');
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
    $(document).on('click', '.btnhapusform', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    });

    $('#icd9').select2({

    });
    $('#icd10').select2({

    });
    </script>