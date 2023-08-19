<?= form_open('Back/Pages/Admin/hapusbanyak', ['class' => 'formhapusbanyak']) ?>
<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="dataAkun">
        <thead>
            <tr>

                <th>No</th>
                <th>Nama Obat</th>
                <th>Kode Obat</th>
                <th>Jumlah</th>
                <th>Jenis Keluar Obat</th>
                <th>Tanggal keluar</th>

                <th>Keterangan</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<?= form_close(); ?>
<script>
function listdataadmin() {
    var table = $('#dataAkun').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= site_url('Back/Keluar/listdata') ?>",
            "type": "POST"
        },
        //OPTIONAL
        "columDefs": [{
            "targets": 0,
            "orderable": false,
        }],
    })
}
$(document).ready(function() {
    listdataadmin();



});

function edit(id_obat_keluar) {
    $.ajax({
        type: "post",
        url: "<?= site_url('Back/Keluar/formedit') ?>",
        data: {
            id_obat_keluar: id_obat_keluar
        },
        dataType: "json",
        success: function(response) {
            if (response.sukses) {
                $('.viewmodal').html(response.sukses).show();
                $('#modaledit').modal('show');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

function hapus(id_obat_keluar) {
    Swal.fire({
        title: 'Peringatan',
        text: `Yakin Untuk Menghapus Data Ini ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#072DD6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ya',
        cancelButtonText: 'tidak',
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "<?= site_url('Back/Keluar/hapus') ?>",
                data: {
                    id_obat_keluar: id_obat_keluar
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                        dataAdmin();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    });
}
</script>