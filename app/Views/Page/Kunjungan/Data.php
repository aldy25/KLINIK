<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="data">
        <thead>
            <tr>

                <th>No</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<script>
function listdataadmin() {
    var table = $('#data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= site_url('Back/Kunjungan/listdata') ?>",
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


function hapus(id_kunjungan) {
    Swal.fire({
        title: 'Pasien',
        text: `Yakin Untuk Menghapus Data Pasien Ini ?`,
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
                url: "<?= site_url('Back/Kunjungan/hapus') ?>",
                data: {
                    id_kunjungan: id_kunjungan
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