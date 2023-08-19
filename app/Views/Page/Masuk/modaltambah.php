<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Obat Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Masuk/simpandata', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group row">
                    <label style=" color:black;" for="nama_obat" class="col-sm-2 col-form-label">Nama Obat</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="nama_obat" id="nama_obat"
                            placeholder="ex: raniditin" class="form-control">
                        <div class="invalid-feedback errornama_obat">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="kode_obat" class="col-sm-2 col-form-label">Kode Obat</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="text" name="kode_obat" placeholder="ex: A001" id="kode_obat"
                            class="form-control">
                        <div class="invalid-feedback errorkode_obat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="jumlah_obat" class="col-sm-2 col-form-label">Jumlah Obat</label>
                    <div class="col-sm-8">
                        <input style="color:black;" type="number" placeholder="ex: 300" name="jumlah_obat"
                            id="jumlah_obat" class="form-control">
                        <div class="invalid-feedback errorjumlah_obat">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-8">
                        <select name="satuan" id="satuan" class="form-control">
                            <option style="color:black;" value="">--- Pilih ---</option>
                            <option style="color:black;" value="keping">Keping</option>
                            <option style="color:black;" value="botol">Botol</option>
                            <option style="color:black;" value="butir">Butir</option>
                            <option style="color:black;" value="tablet">Tablet</option>
                            <option style="color:black;" value="kapsul">Kapsul</option>
                            <option style="color:black;" value="kotak">Kotak</option>
                            <option style="color:black;" value="pcs">PCS</option>
                            <option style="color:black;" value="buah">Buah</option>
                        </select>
                        <div class="invalid-feedback errorsatuan">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label style=" color:black;" for="harga_satuan" class="col-sm-2 col-form-label">Harga Per Satuan
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="number" placeholder="ex: 10000" name="harga_satuan"
                            id="harga_satuan" class="form-control">
                        <div class="invalid-feedback errorharga_satuan">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label style=" color:black;" for="tanggal_exp" class="col-sm-2 col-form-label">Tanggal Expired
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="date" name="tanggal_exp" id="tanggal_exp"
                            class="form-control">
                        <div class="invalid-feedback errortanggal_exp">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="sumber" class="col-sm-2 col-form-label">Sumber Distribusi </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" placeholder="PT Adi Yasa" name="sumber" id="sumber"
                            class="form-control">
                        <div class="invalid-feedback errorsumber">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Masuk
                    </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="date" name="tanggal_masuk" id="tanggal_masuk"
                            class="form-control">
                        <div class="invalid-feedback errortanggal_masuk">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Keterangan </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="text" name="keterangan" id="keterangan" class="form-control">
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

        // $('.btnaddform').click(function(e) {
        //     e.preventDefault();
        //     $('.formtambahh').append(`
        //         <tr>
        //                 <td>
        //                             <select name="obat[]" class="form-control">

        //                                 <option value="Laki-Laki"></option>
        //                                 <option value="Perempuan">Sanmol</option>
        //                             </select>
        //                         </td>
        //                         <td>
        //                             <select name="resep[]" class="form-control">
        //                                 <option value="1">2 x 1 Sesudah Makan</option>
        //                                 <option value="1">3 x 1 Sesudah Makan</option>
        //                                 <option value="1">1 x Sesudah Makan</option>
        //                             </select>
        //                         </td>
        //                         <td>
        //         <button type="button" class="btn btn-danger btnhapusform">
        //             <i class="fa fa-trash"></i>
        //         </button>
        //     </td>

        // </tr>
        //     `);
        // });
        $(".formtambah").submit(function(e) {
            e.preventDefault();
            let form = $('.formtambah')[0];
            let data = new FormData(form);
            $.ajax({
                type: "post",
                url: "<?= site_url('Back/Masuk/simpandata') ?>",
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
                        if (response.error.satuan) {
                            $('#satuan').addClass('is-invalid');
                            $('.errorsatuan').html(response.error.satuan);
                        } else {
                            $('#satuan').removeClass('is-invalid');
                            $('.errorsatuan').html('');
                        }
                        if (response.error.tanggal_exp) {
                            $('#tanggal_exp').addClass('is-invalid');
                            $('.errortanggal_exp').html(response.error.tanggal_exp);
                        } else {
                            $('#tanggal_exp').removeClass('is-invalid');
                            $('.errortanggal_exp').html('');
                        }
                        if (response.error.sumber) {
                            $('#sumber').addClass('is-invalid');
                            $('.errorsumber').html(response.error.sumber);
                        } else {
                            $('#sumber').removeClass('is-invalid');
                            $('.errorsumber').html('');
                        }
                        if (response.error.tanggal_masuk) {
                            $('#tanggal_masuk').addClass('is-invalid');
                            $('.errortanggal_masuk').html(response.error.tanggal_masuk);
                        } else {
                            $('#tanggal_masuk').removeClass('is-invalid');
                            $('.errortanggal_masuk').html('');
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