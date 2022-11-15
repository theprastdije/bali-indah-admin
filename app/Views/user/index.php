<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<?php $date = $user['created_at']; ?>
<div class="row">
    <div class="col-lg-6">
        <?php if (session()->getFlashdata('user')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('user'); ?></div>
        <?php endif; ?>
    </div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="text-primary m-0 font-weight-bold">Profil User</h6>
            </div>
            <div class="row text-center mt-3 mb-2">
                <div class="col-12">
                    <img src="/img/profile-img/<?= $user['profile_img']; ?>" alt="<?= $user['username']; ?>" class="card-img user-image rounded-circle border border-primary">
                </div>
            </div>
            <div class="row text-center mt-2 mb-1">
                <div class="col-12">
                    <?php if (in_groups('Super admin')) : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-success d-inline">Super admin</span></p>
                    <?php elseif (in_groups('Owner')) : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-primary d-inline">Owner</span></p>
                    <?php elseif (in_groups('Manajer')) : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-info d-inline">Manajer</span></p>
                    <?php elseif (in_groups('Kasir')) : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-warning d-inline">Kasir</span></p>
                    <?php elseif (in_groups('Staf')) : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-danger d-inline">Staf</span></p>
                    <?php else : ?>
                        <p class="font-weight-bold">Role: <span class="badge badge-secondary d-inline">N/A</span></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-12">
                    <a href="/user/edit/<?= $user['id']; ?>" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit Profil</a>
                </div>
            </div>
            <?php if (!$user_detail) : ?>
                <div class="row mt-3 justify-content-center">
                    <div class="col-10">
                        <div class="alert alert-warning"><i class="fas fa-fw fa-exclamation-triangle"></i> Profil Anda belum lengkap. Silakan lengkapi profil Anda terlebih dahulu.</div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row mt-1 mb-3 justify-content-center">
                <div class="col-10">
                    <form class="user">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <label for="username" class="font-weight-bold">Username</label>
                            <input type="text" class="form-control form-control-user" name="username" id="username" value="<?= $user['username']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fullname" class="font-weight-bold">Nama Lengkap</label>
                            <?php if ($user['full_name'] == "") : ?>
                                <input type="text" class="form-control form-control-user" name="fullname" id="fullname" value="Belum diatur" readonly>
                            <?php else : ?>
                                <input type="text" class="form-control form-control-user" name="fullname" id="fullname" value="<?= $user['full_name']; ?>" readonly>
                            <?php endif; ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control form-control-user" name="email" id="email" value="<?= $user['email']; ?>" readonly>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="telepon" class="font-weight-bold">Telepon</label>
                                <?php if (!$user_detail) : ?>
                                    <input type="tel" class="form-control form-control-user" name="telepon" id="telepon" value="Belum diatur" readonly>
                                <?php else : ?>
                                    <?php if ($user_detail['tel']) : ?>
                                        <input type="tel" class="form-control form-control-user" name="telepon" id="telepon" value="<?= $user_detail['tel']; ?>" readonly>
                                    <?php else : ?>
                                        <input type="tel" class="form-control form-control-user" name="telepon" id="telepon" value="Belum diatur" readonly>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="font-weight-bold">Alamat</label>
                            <?php if (!$user_detail) : ?>
                                <textarea name="alamat" id="alamat" class="form-control form-control-user" cols="auto" rows="2" readonly>Belum diatur</textarea>
                            <?php else : ?>
                                <?php if ($user_detail['alamat']) : ?>
                                    <textarea name="alamat" id="alamat" class="form-control form-control-user" cols="auto" rows="2" readonly><?= $user_detail['alamat']; ?></textarea>
                                <?php else : ?>
                                    <textarea name="alamat" id="alamat" class="form-control form-control-user" cols="auto" rows="2" readonly>Belum diatur</textarea>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="gender" class="font-weight-bold">Jenis Kelamin</label>
                                <?php if (!$user_detail) : ?>
                                    <input type="text" class="form-control form-control-user" name="gender" id="gender" value="Tidak disebutkan" readonly>
                                <?php else : ?>
                                    <?php if ($user_detail['gender'] == 'l') : ?>
                                        <input type="text" class="form-control form-control-user" name="gender" id="gender" value="Laki-laki" readonly>
                                    <?php elseif ($user_detail['gender'] == 'p') : ?>
                                        <input type="text" class="form-control form-control-user" name="gender" id="gender" value="Perempuan" readonly>
                                    <?php else : ?>
                                        <input type="text" class="form-control form-control-user" name="gender" id="gender" value="Tidak disebutkan" readonly>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="tmp_lahir" class="font-weight-bold">Tempat Lahir</label>
                                <?php if (!$user_detail) : ?>
                                    <input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir" value="Belum diatur" readonly>
                                <?php else : ?>
                                    <?php if ($user_detail['tempat_lahir']) : ?>
                                        <input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir" value="<?= $user_detail['tempat_lahir']; ?>" readonly>
                                    <?php else : ?>
                                        <input type="text" class="form-control form-control-user" name="tmp_lahir" id="tmp_lahir" value="Belum diatur" readonly>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group col-md-4 col-sm-12">
                                <label for="tgl_lahir" class="font-weight-bold">Tgl. Lahir</label>
                                <?php if (!$user_detail) : ?>
                                    <input type="date" class="form-control form-control-user" name="tgl_lahir" id="tgl_lahir" readonly>
                                <?php else : ?>
                                    <?php if ($user_detail['tgl_lahir']) : ?>
                                        <input type="date" class="form-control form-control-user" name="tgl_lahir" id="tgl_lahir" value="<?= $user_detail['tgl_lahir']; ?>" readonly>
                                    <?php else : ?>
                                        <input type="date" class="form-control form-control-user" name="tgl_lahir" id="tgl_lahir" readonly>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="registerDate" class="font-weight-bold">Tgl. Registrasi Akun</label>
                                <input type="text" class="form-control form-control-user" name="registerDate" id="registerDate" value="<?= date_indo($date); ?>" readonly>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="joinDate" class="font-weight-bold">Tgl. Terdaftar Sebagai Staf</label>
                                <input type="text" class="form-control form-control-user" name="joinDate" id="joinDate" value="<?= date_indo($date); ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>