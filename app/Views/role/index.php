<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-8">
        <div class="alert alert-warning pb-0">
            <i class="fas fa-fw fa-exclamation-circle"></i> Perhatikan hal berikut ini:
            <ul>
                <li>Mohon untuk tidak mengubah role jika tidak diperlukan</li>
                <li>Apabila ingin mengubah role, pastikan juga untuk mengubah kode programnya</li>
            </ul>
        </div>
        <?php if ($validation->hasError('role', 'role_desc')) : ?>
            <div class="alert alert-danger pb-0">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('role')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('role'); ?></div>
        <?php endif; ?>
        <a href="" class="btn btn-info mb-3" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-plus"></i> Tambah Role</a>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $role) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $role['name']; ?></th>
                            <td><?= $role['description']; ?></td>
                            <td>
                                <a href="/role/edit/<?= $role['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                <form action="/role/<?= $role['id']; ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?');"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Role -->
<div class="modal fade" id="roleModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/role/save" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="role_desc" name="role_desc" placeholder="Deskripsi">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>