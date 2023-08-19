<?= $this->extend('Base/Main') ?>
<?= $this->extend('Base/Menu') ?>
<?= $this->section('Konten') ?>
<!-- DataTables -->
<link href="<?= base_url() ?>https://cdn.datatable.net/rowreoder/1.2.7/css/rowreoder.datatable.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url() ?>https://cdn.datatable.net/responsive/2.2.5/css/responsive.datatable.min.css"
    rel="stylesheet" type="text/css" />

<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
    type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/js/webcam.min.js"></script>
<div class="row">


    <div class="col-sm-12">
        <div class="card m-b-30">

            <div class="card-body">

                <p class="card-text viewdata">

                </p>

            </div>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;">

</div>

<script>
function dataAdmin() {
    $.ajax({
        url: "<?= site_url('Back/Berobat/ambildataa') ?>",
        dataType: "json",
        success: function(response) {
            $('.viewdata').html(response.data);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}
$(document).ready(function() {
    dataAdmin();

});
</script>
<?= $this->endsection() ?>