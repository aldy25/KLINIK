<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemeriksaan Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Berobat/updatedata', ['class' => 'formedit']) ?>
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

                <!-- <div class="form-group row">
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
                </div> -->
                <div class="form-group row">
                    <label style=" color:black;" for="tindakan" class="col-sm-2 col-form-label">Tindakan </label>
                    <div class="col-sm-8">
                        <textarea style=" color:black;" name="tindakan" id="tindakan" class="form-control">
-
                        </textarea>

                        <div class="invalid-feedback errortindakan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="diagnosa" class="col-sm-2 col-form-label">Diagnosa </label>
                    <div class="col-sm-8">
                        <textarea style=" color:black;" name="diagnosa" id="diagnosa" class="form-control">
-
                        </textarea>

                        <div class="invalid-feedback errordiagnosa">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="terapi" class="col-sm-2 col-form-label">Terapi </label>
                    <div class="col-sm-8">
                        <input value="-" style=" color:black;" type="text" name="terapi"
                            placeholder="ex: terapi lingkungan" id="terapi" class="form-control">
                        <div class="invalid-feedback errorterapi">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="edukasi" class="col-sm-2 col-form-label">Edukasi </label>
                    <div class="col-sm-8">
                        <input value="-" style=" color:black;" type="text" name="edukasi"
                            placeholder="ex: jangan makan daging" id="edukasi" class="form-control">
                        <div class="invalid-feedback erroredukasi">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="rujukan" class="col-sm-2 col-form-label">Rujukan </label>
                    <div class="col-sm-8">
                        <input value="-" style=" color:black;" type="text" name="rujukan"
                            placeholder="ex: RS Raden Mataher" id="rujukan" class="form-control">
                        <div class="invalid-feedback errorrujukan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Keterangan </label>
                    <div class="col-sm-8">
                        <input value="<?= $keterangan ?>" style=" color:black;" type="text" name="keterangan"
                            id="keterangan" class="form-control">
                        <div class="invalid-feedback errorketerangan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Obat </label>

                    <div class="col-sm-8">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Jumlah</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="formtambahh">
                                <tr>

                                    <td>
                                        <select required="" name="obat[]" id="obat" class="form-control">
                                            <option style="color:black;" value="">----PILIH----</option>
                                            <?php
                                            $db   = \Config\Database::connect();
                                            $datapasien = $db->query("SELECT * from tbl_obat");
                                            $data = $datapasien->getResult();
                                            foreach ($data as $row) {
                                            ?>
                                            <option style="color:black;" value="<?= $row->id_obat ?>">
                                                <?= $row->nama_obat ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback errorobat">
                                        </div>
                                    </td>
                                    <td>
                                        <input placeholder="EX : 3X1 Sesudah Makan" required="" style=" color:black;"
                                            type="text" name="resep[]" id="resep" class="form-control">
                                        <div class="invalid-feedback errorresep">
                                        </div>
                                    </td>
                                    <td>
                                        <input placeholder="" required="" style=" color:black;" type="text"
                                            name="jumlah[]" id="jumlah[]" class="form-control">
                                        <div class="invalid-feedback errorjumlah[]">
                                        </div>
                                    </td>


                                    <td>
                                        <button type="button" class="btn btn-primary btnaddform">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        $('.btnaddform').click(function(e) {
            e.preventDefault();
            $('.formtambahh').append(`
                <tr>
                <td>
                                        <select required="" name="obat[]" id="obat" class="form-control">
                                            <option style="color:black;" value="">----PILIH----</option>
                                            <?php
                                            $db   = \Config\Database::connect();
                                            $datapasien = $db->query("SELECT * from tbl_obat");
                                            $data = $datapasien->getResult();
                                            foreach ($data as $row) {
                                            ?>
                                            <option style="color:black;" value="<?= $row->id_obat ?>">
                                                <?= $row->nama_obat ?></option>

                                            <?php } ?>
                                        </select>
                                        <div class="invalid-feedback errorobat">
                                        </div>
                                    </td>
                                <td>
                                <input required="" placeholder="EX : 3X1 Sesudah Makan" style=" color:black;" type="text"name="resep[]" id="resep"
                                            class="form-control">
                                        
                                </td>
                                <td>
                                        <input placeholder="" required="" style=" color:black;"
                                            type="text" name="jumlah[]" id="jumlah[]" class="form-control">
                                        <div class="invalid-feedback errorjumlah[]">
                                        </div>
                                    </td>
                                <td>
                <button type="button" class="btn btn-danger btnhapusform">
                    <i class="fa fa-trash"></i>
                </button>
            </td>

        </tr>
            `);
        });
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
                        if (response.error.tindakan) {
                            $('#tindakan').addClass('is-invalid');
                            $('.errortindakan').html(response.error.tindakan);
                        } else {
                            $('#tindakan').removeClass('is-invalid');
                            $('.errortindakan').html('');
                        }
                        if (response.error.diagnosa) {
                            $('#diagnosa').addClass('is-invalid');
                            $('.errordiagnosa').html(response.error.diagnosa);
                        } else {
                            $('#diagnosa').removeClass('is-invalid');
                            $('.errordiagnosa').html('');
                        }
                        if (response.error.terapi) {
                            $('#terapi').addClass('is-invalid');
                            $('.errorterapi').html(response.error.terapi);
                        } else {
                            $('#terapi').removeClass('is-invalid');
                            $('.errorterapi').html('');
                        }
                        if (response.error.edukasi) {
                            $('#edukasi').addClass('is-invalid');
                            $('.erroredukasi').html(response.error.edukasi);
                        } else {
                            $('#edukasi').removeClass('is-invalid');
                            $('.erroredukasi').html('');
                        }
                        if (response.error.rujukan) {
                            $('#rujukan').addClass('is-invalid');
                            $('.errorrujukan').html(response.error.rujukan);
                        } else {
                            $('#rujukan').removeClass('is-invalid');
                            $('.errorrujukan').html('');
                        }
                        if (response.error.keterangan) {
                            $('#keterangan').addClass('is-invalid');
                            $('.errorketerangan').html(response.error.keterangan);
                        } else {
                            $('#keterangan').removeClass('is-invalid');
                            $('.errorketerangan').html('');
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
    $('#obat').select2({

    });
    $('#icd9').select2({

    });
    $('#icd10').select2({

    });
    </script>