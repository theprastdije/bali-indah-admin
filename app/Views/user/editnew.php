<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-4 mt-2">
        <!-- <h4>Edit Profil</h4> -->
        <?php if ($validation->hasError('username', 'fullname', 'email', 'user_img')) : ?>
            <div class="alert alert-danger pb-0">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <form action="/user/update/<?= $user['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
            </div>
            <div class="form-group">
                <label for="fullname">Nama Lengkap</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['full_name']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="user_img">Foto Profil</label>
                <input type="text" class="form-control" id="user_img" name="user_img" value="<?= $user['profile_img']; ?>">
                <!-- <label>Foto Profil</label>
                <div class="custom-file">
                    <input type="file" class="form-control-file custom-file-input" id="user_img" name="user_img">
                    <label class="custom-file-label" for="user_img">Pilih foto profil ...</label>
                </div> -->
            </div>
            <div class="form-group">
                <a href="/user" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>