<?= $this->extend('Auth/Main') ?>
<?= $this->section('Konten') ?>
<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">

            <h6 style="padding-left: 20%; padding-right:20%; font-family: 'Montserrat';line-height: 20px; font-weight: 600;color:#2148C0;"
                class="text-center mt-3 m-b-15">
                SISTEM INFORMASI KLINIK DOKTER YANTI
            </h6>

            <h3 class="text-center mt-0 m-b-15">
                <img class="logo logo-admin" src="<?= base_url() ?>/assets/images/logo.png" height="120" alt="logo">

            </h3>


            <div class="p-3">
                <?= form_open('Back/Auth/cekuser', ['class' => 'formlogin']) ?>
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <div class="col-12">
                        <input style="display:none;" class="form-control " type="text" placeholder="pesan" name="pesan"
                            id="pesan">
                        <div style="text-align:center; font-size:25px; " class="invalid-feedback errorpesan">

                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <input style="background-color:#DBE8F4; border:1px solid #2148C0;" class="form-control "
                            type="text" placeholder="Username" name="username" id="username">
                        <div class="invalid-feedback errorusername">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12">
                        <input style="background-color:#DBE8F4; border:1px solid #2148C0;" class="form-control"
                            type="password" placeholder="Password" name="password" id="password">
                        <div class="invalid-feedback errorpassword">

                        </div>
                    </div>
                </div>
                <div class="form-group text-center row m-t-20">
                    <div class="col-12">
                        <button
                            style="background-color:blue; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.3);  color: #ffff; font-weight: 600; border:1px solid #2148C0;"
                            class="btn btn-primary btn-block waves-effect waves-light btnlogin"
                            type="submit">LOGIN</button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>

        </div>
    </div>
</div>
<!-- App js -->
<script>
$(document).ready(function() {
    $(".formlogin").submit(function(e) {
        e.preventDefault();
        let form = $('.formlogin')[0];
        let data = new FormData(form);
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),

            dataType: "json",
            beforeSend: function() {
                $('.btnslogin').attr('disable', 'disabled');
                $('.btnlogin').html(
                    '  <p> <i class="fa fa-spin fa-spinner"></i> Loading...</p>');
            },
            complete: function() {
                $('.btnlogin').removeAttr('disable', );
                $('.btnlogin').html('LOGIN');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.username) {
                        $('#username').addClass('is-invalid');
                        $('.errorusername').html(response.error.username);
                    } else {
                        $('#username').removeClass('is-invalid');
                        $('.errorusername').html('');
                    }
                    if (response.error.password) {
                        $('#password').addClass('is-invalid');
                        $('.errorpassword').html(response.error.password);
                    } else {
                        $('#password').removeClass('is-invalid');
                        $('.errorpassword').html('');
                    }
                    if (response.error.pesan) {
                        $('#pesan').addClass('is-invalid');
                        $('.errorpesan').html(response.error.pesan);
                    } else {
                        $('#pesan').removeClass('is-invalid');
                        $('.errorpesan').html('');
                    }

                }
                if (response.sukses) {
                    window.location = response.sukses.link;
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
<?= $this->endsection() ?>