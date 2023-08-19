<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Stock Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Obat/updatedata', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_obat ?>" style="color:black;" type="text" name="id" id="id"
                            class="form-control">
                        <div class="invalid-feedback errorid">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_obat ?>" style="color:black;" type="text" name="nama_obat"
                            id="nama_obat" class="form-control">
                        <div class="invalid-feedback errornama_obat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="kode_obat" class="col-sm-2 col-form-label">Kode Obat</label>
                    <div class="col-sm-8">
                        <input value="<?= $kode_obat ?>" style="color:black;" type="text" name="kode_obat"
                            id="kode_obat" class="form-control">
                        <div class="invalid-feedback errorkode_obat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="jumlah_obat" class="col-sm-2 col-form-label">Jumlah Obat</label>
                    <div class="col-sm-8">
                        <input value="<?= $jumlah_obat ?>" style="color:black;" type="text" name="jumlah_obat"
                            id="jumlah_obat" class="form-control">
                        <div class="invalid-feedback errorjumlah_obat">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label style=" color:black;" for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan
                    </label>
                    <div class="col-sm-8">
                        <input value="<?= $harga_satuan ?>" style=" color:black;" type="number" name="harga_satuan"
                            id="harga_satuan" class="form-control">
                        <div class="invalid-feedback errorharga_satuan">
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
                <!-- <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Obat </label>

                    <div class="col-sm-8">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Obat</th>
                                    <th>Resep</th>

                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody class="formtambahh">
                                <tr>

                                    <td>
                                        <select name="obat[]" class="form-control">
                                            <option value="Laki-Laki">Paramex</option>
                                            <option value="Perempuan">Sanmol</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="resep[]" class="form-control">
                                            <option value="1">2 x 1 Sesudah Makan</option>
                                            <option value="1">3 x 1 Sesudah Makan</option>
                                            <option value="1">1 x Sesudah Makan</option>
                                        </select>
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

                </div> -->


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
                        if (response.error.nama_obat) {
                            $('#nama_obat').addClass('is-invalid');
                            $('.errornama_obat').html(response.error.nama_obat);
                        } else {
                            $('#nama_obat').removeClass('is-invalid');
                            $('.errornama_obat').html('');
                        }
                        if (response.error.kode_obat) {
                            $('#kode_obat').addClass('is-invalid');
                            $('.errorkode_obat').html(response.error.kode_obat);
                        } else {
                            $('#kode_obat').removeClass('is-invalid');
                            $('.errorkode_obat').html('');
                        }

                        if (response.error.jumlah_obat) {
                            $('#jumlah_obat').addClass('is-invalid');
                            $('.errorjumlah_obat').html(response.error.jumlah_obat);
                        } else {
                            $('#jumlah_obat').removeClass('is-invalid');
                            $('.errorjumlah_obat').html('');
                        }
                        if (response.error.harga_satuan) {
                            $('#harga_satuan').addClass('is-invalid');
                            $('.errorharga_satuan').html(response.error.harga_satuan);
                        } else {
                            $('#harga_satuan').removeClass('is-invalid');
                            $('.errorharga_satuan').html('');
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
    </script>