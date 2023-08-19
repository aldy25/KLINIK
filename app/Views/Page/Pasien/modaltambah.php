<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Pasien/simpandata', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <label style=" color:black;" for="nik" class="col-sm-2 col-form-label">Nik</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" placeholder="ex: 1611012504010003" name="nik" id="nik"
                            class="form-control">
                        <div class="invalid-feedback errornik">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" placeholder="ex: Muhamad Rama" name="nama_pasien"
                            id="nama_pasien" class="form-control">
                        <div class="invalid-feedback errornama_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="jk_pasien" class="col-sm-2 col-form-label">Jenis Kelamin </label>
                    <div class="col-sm-8">
                        <select name="jk_pasien" id="jk_pasien" class="form-control">
                            <option style="color:black;" value="">--Pilih--</option>
                            <option style="color:black;" value="Laki-Laki">Laki-Laki</option>
                            <option style="color:black;" value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorjk_pasien">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="date" placeholder="ex: 24" name="tanggal_lahir"
                            id="tanggal_lahir" class="form-control">
                        <div class="invalid-feedback errortanggal_lahir">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="alamat_pasien" class="col-sm-2 col-form-label">Alamat Pasien
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="alamat_pasien" placeholder="ex: Auduri 2"
                            id="alamat_pasien" class="form-control">
                        <div class="invalid-feedback erroralamat_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="agama" class="col-sm-2 col-form-label">Agama
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="agama" placeholder="ex: Islam" id="agama"
                            class="form-control">
                        <div class="invalid-feedback erroragama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="pekerjaan" placeholder="ex: Kuli" id="pekerjaan"
                            class="form-control">
                        <div class="invalid-feedback errorpekerjaan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="pendidikan" class="col-sm-2 col-form-label">Pendidikan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="pendidikan" placeholder="ex: Kuli"
                            id="pendidikan" class="form-control">
                        <div class="invalid-feedback errorpendidikan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="status_perkawinan" class="col-sm-2 col-form-label">Status
                        Perkawinan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="status_perkawinan" placeholder="ex: Kuli"
                            id="status_perkawinan" class="form-control">
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
        $(".formtambah").submit(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('Back/Pasien/simpandata') ?>",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', );
                    $('.btnsimpan').html('Simpan');
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
                        if (response.error.tanggal_lahir) {
                            $('#tanggal_lahir').addClass('is-invalid');
                            $('.errortanggal_lahir').html(response.error.tanggal_lahir);
                        } else {
                            $('#tanggal_lahir').removeClass('is-invalid');
                            $('.errortanggal_lahir').html('');
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
                        $('#modaltambah').modal('hide');
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