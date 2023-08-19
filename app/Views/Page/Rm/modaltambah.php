<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemeriksaan Awal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Rm/simpandata', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id_pasien" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_pasien ?>" style="color:black;" type="text" name="id_pasien" id="id_pasien" class="form-control">
                        <div class="invalid-feedback errorid_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="nama_pasien" class="col-sm-2 col-form-label">Nama Pasien</label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_pasien ?>" disabled style="color:black;" type="text" name="nama_pasien" id="nama_pasien" class="form-control">
                        <div class="invalid-feedback errornama_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="dokter" class="col-sm-2 col-form-label">Pilih Dokter</label>
                    <div class="col-sm-8">
                        <select name="dokter" id="dokter" class="form-control">
                            <option style="color:black;" value="">----------- Pilih ----------</option>
                            <?php
                            $db   = \Config\Database::connect();
                            $datapasien = $db->query("SELECT * from tbl_user WHERE level ='Dokter'");
                            $data = $datapasien->getResult();
                            foreach ($data as $row) {
                            ?>
                                <option style="color:black;" value="<?= $row->id_user ?>"><?= $row->nama_user ?></option>

                            <?php } ?>


                        </select>
                        <div class="invalid-feedback errordokter">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="dokter" class="col-sm-2 col-form-label">Pilih Layanan</label>
                    <div class="col-sm-8">
                        <select name="layanan" id="layanan" class="form-control">
                            <option style="color:black;" value="">----------- Pilih ----------</option>
                            <?php
                            $db   = \Config\Database::connect();
                            $datapasien = $db->query("SELECT * from tbl_layanan ");
                            $data = $datapasien->getResult();
                            foreach ($data as $row) {
                            ?>
                                <option style="color:black;" value="<?= $row->id_layanan ?>"><?= $row->nama_layanan ?>
                                </option>

                            <?php } ?>


                        </select>
                        <div class="invalid-feedback errorlayanan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keluhan" class="col-sm-2 col-form-label">Pemeriksaan Awal </label>
                    <div class="col-sm-8">



                        <input value="-" style=" color:black;" placeholder="ex: batuk-batuk dan sesak nafas" type="text" name="keluhan" id="keluhan" class="form-control">
                        <div class="invalid-feedback errorkeluhan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi Badan
                    </label>
                    <div class="col-sm-8">
                        <input value="-" placeholder="ex : 177" style=" color:black;" type="number" name="tinggi_badan" id="tinggi_badan" class="form-control">
                        <div class="invalid-feedback errortinggi_badan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="berat_badan" class="col-sm-2 col-form-label">Berat Badan </label>
                    <div class="col-sm-8">
                        <input placeholder="ex: 66" style=" color:black;" type="number" name="berat_badan" id="berat_badan" class="form-control">
                        <div class="invalid-feedback errorberat_badan">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="tekanan_darah" class="col-sm-2 col-form-label">Tekanan Darah
                    </label>
                    <div class="col-sm-8">
                        <input value="-" placeholder="ex: 110/80" style=" color:black;" type="text" name="tekanan_darah" id="tekanan_darah" class="form-control">
                        <div class="invalid-feedback errortekanan_darah">
                        </div>
                    </div>
                </div>


                <div class="form-group row">
                    <label style=" color:black;" for="waktu" class="col-sm-2 col-form-label">Waktu </label>
                    <div class="col-sm-8">
                        <input style=" color:black;" type="date" name="waktu" id="waktu" class="form-control">
                        <div class="invalid-feedback errorwaktu">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Keterangan </label>
                    <div class="col-sm-8">
                        <input value="-" style=" color:black;" type="text" name="keterangan" id="keterangan" class="form-control">
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
        $('#dokter').select2({

        });
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
                    url: "<?= site_url('Back/Rm/simpandata') ?>",
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
                            if (response.error.nama_pasien) {
                                $('#dokter').addClass('is-invalid');
                                $('.errordokter').html(response.error.dokter);
                            } else {
                                $('#dokter').removeClass('is-invalid');
                                $('.errordokter').html('');
                            }
                            if (response.error.layanan) {
                                $('#layanan').addClass('is-invalid');
                                $('.errorlayanan').html(response.error.layanan);
                            } else {
                                $('#layanan').removeClass('is-invalid');
                                $('.errorlayanan').html('');
                            }
                            if (response.error.dokter) {
                                $('#dokter').addClass('is-invalid');
                                $('.errordokter').html(response.error.dokter);
                            } else {
                                $('#dokter').removeClass('is-invalid');
                                $('.errordokter').html('');
                            }


                            if (response.error.tinggi_badan) {
                                $('#tinggi_badan').addClass('is-invalid');
                                $('.errortinggi_badan').html(response.error.tinggi_badan);
                            } else {
                                $('#tinggi_badan').removeClass('is-invalid');
                                $('.errortinggi_badan').html('');
                            }
                            if (response.error.berat_badan) {
                                $('#berat_badan').addClass('is-invalid');
                                $('.errorberat_badan').html(response.error.berat_badan);
                            } else {
                                $('#berat_badan').removeClass('is-invalid');
                                $('.errorberat_badan').html('');
                            }
                            if (response.error.tekanan_darah) {
                                $('#tekanan_darah').addClass('is-invalid');
                                $('.errortekanan_darah').html(response.error.tekanan_darah);
                            } else {
                                $('#tekanan_darah').removeClass('is-invalid');
                                $('.errortekanan_darah').html('');
                            }
                            if (response.error.umur) {
                                $('#umur').addClass('is-invalid');
                                $('.errorumur').html(response.error.umur);
                            } else {
                                $('#umur').removeClass('is-invalid');
                                $('.errorumur').html('');
                            }
                            if (response.error.keluhan) {
                                $('#keluhan').addClass('is-invalid');
                                $('.errorkeluhan').html(response.error.keluhan);
                            } else {
                                $('#keluhan').removeClass('is-invalid');
                                $('.errorkeluhan').html('');
                            }
                            if (response.error.waktu) {
                                $('#waktu').addClass('is-invalid');
                                $('.errorwaktu').html(response.error.waktu);
                            } else {
                                $('#waktu').removeClass('is-invalid');
                                $('.errorwaktu').html('');
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
        $(document).on('click', '.btnhapusform', function(e) {
            e.preventDefault();
            $(this).parents('tr').remove();
        });
    </script>