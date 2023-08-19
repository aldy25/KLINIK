<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Antrian Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('Back/Antrian/updatedataa', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="id" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-8">
                        <input value="<?= $id_riwayat ?>" style="color:black;" type="text" name="id" id="id" class="form-control">
                        <div class="invalid-feedback errorid">
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
                    <label style=" color:black;" for="nama_pasien" class="col-sm-2 col-form-label">Nama Layanan</label>
                    <div class="col-sm-8">
                        <input value="<?= $nama_layanan ?>" disabled style="color:black;" type="text" name="nama_pasien" id="nama_pasien" class="form-control">
                        <div class="invalid-feedback errornama_pasien">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="obat" class="col-sm-2 col-form-label">Resep Obat</label>
                    <div class="col-sm-8">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Obat</th>
                                    <th>Resep</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="formtambahh">
                                <?php
                                $this->db = \config\Database::connect();
                                $query_cekuser = $this->db->query("SELECT * from tb_resep  WHERE transaksi='$id_riwayat'");
                                $result = $query_cekuser->getResult();
                                $i = 0;
                                foreach ($result as $row) {
                                    $i++;
                                    $obat = $row->obat;
                                    $query = $this->db->query("SELECT * from tbl_obat  WHERE id_obat='$obat'");
                                    $raw = $query->getRow();
                                ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <?= $raw->nama_obat ?>
                                        </td>
                                        <td>
                                            <?= $row->resep ?>
                                        </td>
                                        <td>
                                            <?= $row->jumlah ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="biaya_lainya" class="col-sm-2 col-form-label">Biaya Lainya</label>
                    <div class="col-sm-8">
                        <input value="0" required style="color:black;" type="number" name="biaya_lainya" id="biaya_lainya" class="form-control">
                        <div class="invalid-feedback errorbiaya_lainya">
                        </div>
                    </div>
                </div>


                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="total_harga" class="col-sm-2 col-form-label">Total Harga </label>
                    <div class="col-sm-8">
                        <input value="<?= $total_harga ?>" style=" color:black;" type="text" name="total_harga" id="total_harga" class="form-control">
                        <div class="invalid-feedback errortotal_harga">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="total_harga2" class="col-sm-2 col-form-label">Total Harga </label>
                    <div class="col-sm-8">
                        <input disabled value="<?= $total_harga ?>" style=" color:black;" type="text" name="total_harga2" id="total_harga2" class="form-control">
                        <div class="invalid-feedback errortotal_harga2">
                        </div>
                    </div>
                </div>
                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="total_harga1" class="col-sm-2 col-form-label">Total Harga </label>
                    <div class="col-sm-8">
                        <input value="<?= $total_harga ?>" style=" color:black;" type="text" name="total_harga1" id="total_harga1" class="form-control">
                        <div class="invalid-feedback errortotal_harga1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="total_bayar" class="col-sm-2 col-form-label">Total Bayar </label>
                    <div class="col-sm-8">
                        <input value="0" required style=" color:black;" type="number" name="total_bayar" id="total_bayar" class="form-control">
                        <div class="invalid-feedback errortotal_bayar">
                        </div>
                    </div>
                </div>
                <div style="display: none;" class="form-group row">
                    <label style=" color:black;" for="kembalian" class="col-sm-2 col-form-label">Total Kembalian
                    </label>
                    <div class="col-sm-8">

                        <input style=" color:black;" type="text" name="kembalian" id="kembalian" class="form-control">
                        <div class="invalid-feedback errorkembalian">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="kembalian1" class="col-sm-2 col-form-label">Total Kembalian
                    </label>
                    <div class="col-sm-8">
                        <input value="0" disabled style=" color:black;" type="text" name="kembalian1" id="kembalian1" class="form-control">
                        <div class="invalid-feedback errorkembalian1">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label style=" color:black;" for="keterangan" class="col-sm-2 col-form-label">Keterangan </label>
                    <div class="col-sm-8">
                        <input required value="<?= $keterangan ?>" style=" color:black;" type="text" name="keterangan" id="keterangan" class="form-control">
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
            $("#biaya_lainya, #total_bayar").keyup(function() {
                var biaya_lainya = $("#biaya_lainya").val();
                var total_harga1 = $('#total_harga1').val();
                var total = parseInt(biaya_lainya) + parseInt(total_harga1);
                $("#total_harga").val(total);
                $("#total_harga2").val(total);
                var total_bayar = $('#total_bayar').val();
                var kembali = parseInt(total_bayar) - parseInt(total);
                $("#kembalian").val(kembali);
                $("#kembalian1").val(kembali);
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
                            if (response.error.biaya_lainya) {
                                $('#biaya_lainya').addClass('is-invalid');
                                $('.errorbiaya_lainya').html(response.error.biaya_lainya);
                            } else {
                                $('#biaya_lainya').removeClass('is-invalid');
                                $('.errorbiaya_lainya').html('');
                            }

                            if (response.error.total_bayar) {
                                $('#total_bayar').addClass('is-invalid');
                                $('.errortotal_bayar').html(response.error.total_bayar);
                            } else {
                                $('#total_bayar').removeClass('is-invalid');
                                $('.errortotal_bayar').html('');
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