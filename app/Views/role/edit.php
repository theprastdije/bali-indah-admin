<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-4 mt-2">
        <h4>Edit Role</h4>
        <?php if ($validation->hasError('role', 'role_desc')) : ?>
            <div class="alert alert-danger pb-0">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <form action="/role/update/<?= $role['id']; ?>" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $role['id']; ?>">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" class="form-control" id="role" name="role" value="<?= $role['name']; ?>">
            </div>
            <div class="form-group">
                <label for="role_desc">Deskripsi</label>
                <input type="text" class="form-control" id="role_desc" name="role_desc" value="<?= $role['description']; ?>">
            </div>
            <div class="form-group">
                <a href="/role" class="btn btn-secondary"><i class="fas fa-fw fa-times"></i> Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>