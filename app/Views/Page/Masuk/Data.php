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
                <th>Jumlah Obat</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Expired</th>
                <th>Sumber Distribusi</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan</th>

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
            "url": "<?= site_url('Back/Masuk/listdata') ?>",
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
</script>