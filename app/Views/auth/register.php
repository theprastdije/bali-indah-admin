<?= $this->extend('layout/auth'); ?>

<?= $this->section('logins'); ?>
<div class="container">
    <!-- <= ($validation->hasError('alamat')) ? 'is-invalid' : ''; > -->
    <!-- <= $validation->getError('alamat'); > -->
    <!-- <= old('alamat'); > -->
    <!-- Register form -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-6">
            <div class="card border-0 my-5 shadow-lg o-hidden">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= lang('Auth.register') ?></h1>
                                </div>
                                <form class="user" action="<?= route_to('register') ?>" method="post" enctype="multipart/form-data">
                                    <?= view('Myth\Auth\Views\_message_block') ?>
                                    <?= csrf_field(); ?>
                                    <!-- <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="">
                                        <div class="invalid-feedback"></div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="username"><?= lang('Auth.username') ?></label>
                                        <input type="text" class="form-control form-control-user <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" id="username" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email"><?= lang('Auth.email') ?></label>
                                        <input type="email" class="form-control form-control-user <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" name="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="password"><?= lang('Auth.password') ?></label>
                                            <input type="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" id="password" name="password" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="pass_confirm"><?= lang('Auth.repeatPassword') ?></label>
                                            <input type="password" class="form-control form-control-user <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" id="pass_confirm" name="pass_confirm" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <!-- <hr class="py-1">
                                    <div class="form-group">
                                        <label for="foto">Foto Profil</label>
                                        <div class="row justify-content-center">
                                            <div class="col-sm-3 py-1 mb-sm-0">
                                                <p class="h6 text-center">Preview</p>
                                                <img src="/assets/img/undraw_profile.svg" class="img-thumbnail img-profile img-preview">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input " id="foto" name="foto" onchange="previewProfileImg()">
                                                <div class="invalid-feedback"></div>
                                                <label class="custom-file-label" for="foto">Pilih foto profil...</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?= lang('Auth.register') ?>
                                    </button>
                                    <hr>
                                    <p class="my-2 text-center"><?= lang('Auth.alreadyRegistered') ?> <a href="<?= route_to('login') ?>"><?= lang('Auth.signIn') ?></a></p>
                                    <!-- <p class="my-2 text-center"><a href="/forgot">Lupa Password?</a></p> -->
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