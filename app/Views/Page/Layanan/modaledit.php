<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Layanan/updatedata', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_layanan ?>" style="color:black;" type="text" name="id" id="id"
                            class="form-control">
                        <div class="invalid-feedback errorid">
                        </div>
                    </div>
                </div>



                <div class="form-group row">
                    <label style=" color:black;" for="nama_layanan" class="col-sm-2 col-form-label">Nama Layanan
                    </label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_layanan ?>" style=" color:black;" type="text" name="nama_layanan"
                            id="nama_layanan" class="form-control">
                        <div class="invalid-feedback errornama_layanan">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label style=" color:black;" for="harga" class="col-sm-2 col-form-label">Harga </label>
                    <div class="col-sm-8">
                        <input value="<?= $harga ?>" style=" color:black;" type="number" name="harga" id="harga"
                            class="form-control">
                        <div class="invalid-feedback errorharga">
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
                        if (response.error.nama_layanan) {
                            $('#nama_layanan').addClass('is-invalid');
                            $('.errornama_layanan').html(response.error.nama_layanan);
                        } else {
                            $('#nama_layanan').removeClass('is-invalid');
                            $('.errornama_layanan').html('');
                        }
                        if (response.error.harga) {
                            $('#harga').addClass('is-invalid');
                            $('.errorharga').html(response.error.harga);
                        } else {
                            $('#harga').removeClass('is-invalid');
                            $('.errorharga').html('');
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