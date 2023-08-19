<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="data">
        <thead>
            <tr>

                <th>No</th>
                <th>No RM</th>
                <th>Nama Pasien</th>
                <th>Nama Dokter</th>
                <th>Layanan</th>
                <th>Tinggi Badan </th>
                <th>Berat Badan</th>
                <th>Tekanan Darah</th>

                <th>Anamnesa</th>
                <th>ICD9</th>
                <th>ICD10</th>
                <th>Terapi</th>
                <th>Edukasi</th>
                <th>Rujukan</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
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
            "url": "<?= site_url('Back/Datarm/listdata') ?>",
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


function hapus(id_rm) {
    Swal.fire({
        title: 'Rekam Medis',
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
                url: "<?= site_url('Back/Datarm/hapus') ?>",
                data: {
                    id_rm: id_rm
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