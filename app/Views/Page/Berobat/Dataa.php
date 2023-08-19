<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="data">
        <thead>
            <tr>

                <th>No</th>
                <th>Pasien</th>
                <th>Layanan</th>
                <th>No Rm</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Tekanan Darah</th>

                <th>Anamnesa</th>
                <th>Waktu</th>
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
                "url": "<?= site_url('Back/Berobat/listdataa') ?>",
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

    function edit(id_rm) {
        $.ajax({
            type: "post",
            url: "<?= site_url('Back/Berobat/formedit') ?>",
            data: {
                id_rm: id_rm
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
</script>