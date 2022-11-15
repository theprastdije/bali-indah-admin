<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row d-flex justify-content-center">
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card mb-3">
            <div class="card-header">
                <h6 class="text-primary m-0 font-weight-bold">Profil User</h6>
            </div>
            <div class="card-body">
                <form action="/user/update" method="post" class="user" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="row text-center mt-3 mb-2">
                        <div class="col-12">
                            <img src="/img/profile-img/<?= $user['profile_img']; ?>" alt="<?= $user['username']; ?>" class="card-img user-image img-preview rounded-circle border border-primary">
                        </div>
                    </div>
                    <div class="row mt-1 mb-3 justify-content-center">
                        <div class="col-lg-4 mx-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="profile_img" name="profile_img" value="<?= $user['profile_img']; ?>" onchange="foto_profil()">
                                <label class="custom-file-label profile-label" for="profile_img">Pilih gambar ...</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-3 justify-content-center">
                        <div class="col-10">
                            <span class="font-weight-bold mb-4">Bagian <sup class="text-danger">(*)</sup> wajib diisi</span>
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                <input type="hidden" name="old_img" value="<?= $user['profile_img']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username <sup class="text-danger">(*)</sup></label>
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" id="username" value="<?= $user['username']; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('username'); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Nama Lengkap</label>
                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $user['full_name']; ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email">Email <sup class="text-danger">(*)</sup></label>
                                    <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" name="email" id="email" value="<?= $user['email']; ?>">
                                    <div class="invalid-feedback"><?= $validation->getError('email'); ?></div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="telepon">Telepon</label>
                                    <?php if (!$user_detail) : ?>
                                        <input type="tel" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" name="telepon" id="telepon">
                                    <?php else : ?>
                                        <input type="tel" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : ''; ?>" name="telepon" id="telepon" value="<?= $user_detail['tel']; ?>">
                                    <?php endif; ?>
                                    <div class="invalid-feedback"><?= $validation->getError('telepon'); ?></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <?php if (!$user_detail) : ?>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="auto" rows="2"></textarea>
                                <?php else : ?>
                                    <textarea name="alamat" id="alamat" class="form-control" cols="auto" rows="2"><?= $user_detail['alamat']; ?></textarea>
                                <?php endif; ?>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="gender">Jenis Kelamin</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option>Jenis kelamin ...</option>
                                        <?php if (!$user_detail) : ?>
                                            <option value="l">Laki-laki</option>
                                            <option value="p">Perempuan</option>
                                        <?php else : ?>
                                            <option value="l" <?= ($user_detail['gender'] == 'l') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="p" <?= ($user_detail['gender'] == 'p') ? 'selected' : ''; ?>>Perempuan</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="tmp_lahir">Tempat Lahir</label>
                                    <?php if (!$user_detail) : ?>
                                        <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir">
                                    <?php else : ?>
                                        <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" value="<?= $user_detail['tempat_lahir']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="tgl_lahir">Tgl. Lahir</label>
                                    <?php if (!$user_detail) : ?>
                                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                    <?php else : ?>
                                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?= $user_detail['tgl_lahir']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="tgl_masuk">Tgl. Bergabung</label>
                                    <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                <a href="/user" class="btn btn-primary mx-2"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>