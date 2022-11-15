<?= $this->extend('layout/auth'); ?>

<?= $this->section('logins'); ?>
<div class="container">
    <!-- Flashdata -->
    <!-- <php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success"><= session()->getFlashdata('pesan'); ?></div>
    <php endif; >
    <php if (session()->getFlashdata('pesanlogin')) : ?>
        <div class="alert alert-danger"><= session()->getFlashdata('pesanlogin'); ?></div>
    <php endif; > -->

    <!-- Login form -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-6">
            <div class="card border-0 my-5 shadow-lg o-hidden">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= lang('Auth.loginTitle') ?></h1>
                                </div>
                                <?= view('Myth\Auth\Views\_message_block') ?>
                                <form class="user" action="<?= route_to('login') ?>" method="POST">
                                    <?= csrf_field(); ?>
                                    <!-- Username/Email -->
                                    <?php if ($config->validFields === ['email']) : ?>
                                        <div class="form-group">
                                            <label for="login"><?= lang('Auth.email') ?></label>
                                            <input type="email" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="form-group">
                                            <label for="login"><?= lang('Auth.emailOrUsername') ?></label>
                                            <input type="text" class="form-control form-control-user <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.emailOrUsername') ?>">
                                            <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password"><?= lang('Auth.password') ?></label>
                                        <input type="password" name="password" class="form-control form-control-user <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>">
                                        <div class="invalid-feedback">
                                            <?= session('errors.password') ?>
                                        </div>
                                    </div>
                                    <!-- Remember me -->
                                    <?php if ($config->allowRemembering) : ?>
                                        <div class="form-check my-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                                <i><?= lang('Auth.rememberMe') ?></i>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        <?= lang('Auth.loginAction') ?>
                                    </button>
                                    <hr>
                                </form>
                                <?php if ($config->allowRegistration) : ?>
                                    <p class="my-2 text-center"><a href="<?= route_to('register') ?>"><?= lang('Auth.needAnAccount') ?></a></p>
                                <?php endif; ?>
                                <?php if ($config->activeResetter) : ?>
                                    <p class="my-2 text-center"><a href="<?= route_to('forgot') ?>"><?= lang('Auth.forgotYourPassword') ?></a></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>