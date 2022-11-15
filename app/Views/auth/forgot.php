<?= $this->extend('layout/auth'); ?>

<?= $this->section('logins'); ?>
<div class="container">

    <!-- Forgot password form -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-6">
            <div class="card border-0 my-5 shadow-lg o-hidden">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset Password</h1>
                                </div>
                                <p class="h6 text-center">Silakan gunakan fitur ini apabila Anda lupa password akun Anda.</p>
                                <form class="user" action="#" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="inputUsername" name="inputUsername" aria-describedby="usernameHelp" placeholder="Username">
                                    </div>
                                    <a href="#" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </a>
                                    <hr>
                                    <p class="mt-3 text-center">Belum punya akun? <a href="<?= base_url() ?>/public/register">Register</a></p>
                                    <p class="text-center">Sudah punya akun? <a href="<?= base_url() ?>/public/login">Login</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>