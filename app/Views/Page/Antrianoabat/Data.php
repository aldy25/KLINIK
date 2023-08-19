<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="data">
        <thead>
            <tr>

                <th>No</th>

                <th>Pasien</th>
                <th>Layanan</th>
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
                "url": "<?= site_url('Back/Antrianobat/listdata') ?>",
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

    function edit(id_riwayat) {
        $.ajax({
            type: "post",
            url: "<?= site_url('Back/Antrianobat/formedit') ?>",
            data: {
                id_riwayat: id_riwayat
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