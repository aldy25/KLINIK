<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Pasien/simpandata', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">


                <div class="form-group row">
                    <label style=" color:black;" for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" placeholder="ex: Mardiah Ayu" name="nama_pegawai"
                            id="nama_pegawai" class="form-control">
                        <div class="invalid-feedback errornama_pegawai">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" placeholder="ex: 085266935709" name="no_hp" id="no_hp"
                            class="form-control">
                        <div class="invalid-feedback errorno_hp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="email" placeholder="ex: nifra@gmail.com" name="email"
                            id="email" class="form-control">
                        <div class="invalid-feedback erroremail">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="alamat" class="col-sm-2 col-form-label">Alamat Lengkap</label>
                    <div class="col-sm-8">

                        <textarea style="color:black;" name="alamat" id="alamat" class="form-control"></textarea>

                        <div class="invalid-feedback erroralamat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="jabatan" class="col-sm-2 col-form-label">Jabatan </label>
                    <div class="col-sm-8">
                        <select required="" name="jabatan" id="jabatan" class="form-control">
                            <option style="color:black;" value="">---------------PILIH---------------</option>
                            <?php
                            $db   = \Config\Database::connect();
                            $datajabatan = $db->query("SELECT * from tbl_jabatan");
                            $data = $datajabatan->getResult();
                            foreach ($data as $row) {
                            ?>
                            <option style="color:black;" value="<?= $row->id_jabatan ?>">
                                <?= $row->nama_jabatan ?></option>

                            <?php } ?>
                        </select>

                        <div class="invalid-feedback errorjabatan">
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
                url: "<?= site_url('Back/Pegawai/simpandata') ?>",
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
                        if (response.error.nama_pegawai) {
                            $('#nama_pegawai').addClass('is-invalid');
                            $('.errornama_pegawai').html(response.error.nama_pegawai);
                        } else {
                            $('#nama_pegawai').removeClass('is-invalid');
                            $('.errornama_pegawai').html('');
                        }
                        if (response.error.no_hp) {
                            $('#no_hp').addClass('is-invalid');
                            $('.errorno_hp').html(response.error.no_hp);
                        } else {
                            $('#no_hp').removeClass('is-invalid');
                            $('.errorno_hp').html('');
                        }
                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.erroremail').html('');
                        }
                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
                        }
                        if (response.error.jabatan) {
                            $('#jabatan').addClass('is-invalid');
                            $('.errorjabatan').html(response.error.jabatan);
                        } else {
                            $('#jabatan').removeClass('is-invalid');
                            $('.errorjabatan').html('');
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