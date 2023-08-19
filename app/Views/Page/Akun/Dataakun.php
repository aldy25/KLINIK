<?= form_open('Back/Pages/Admin/hapusbanyak', ['class' => 'formhapusbanyak']) ?>
<p>


</p>
<div class="table-responsive">
    <table class="table table-sm table-striped" id="dataAkun">
        <thead>
            <tr>
                <th>No</th>
                <th>Level</th>
                <th>Role 1</th>
                <th>Role 2</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Username</th>
                <th>Foto</th>
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
            "url": "<?= site_url('Back/Akun/listdata') ?>",
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

function edit(id_user) {
    $.ajax({
        type: "post",
        url: "<?= site_url('Back/Akun/formedit') ?>",
        data: {
            id_user: id_user
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

function hapus(id_user) {
    Swal.fire({
        title: 'Akun',
        text: `Yakin Untuk Menghapus Akun Ini ?`,
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
                url: "<?= site_url('Back/Akun/hapus') ?>",
                data: {
                    id_user: id_user
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