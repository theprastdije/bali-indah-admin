<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<?php if (session()->getFlashdata('userNotFound')) : ?>
    <div class="row">
        <div class="col-lg-4">
            <div class="alert alert-danger"><i class="fas fa-fw fa-times-circle"></i> <?= session()->getFlashdata('userNotFound'); ?></div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List User Terdaftar</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Role</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $user['username']; ?></td>
                                    <td><?= $user['full_name']; ?></td>
                                    <td><?= $user['role']; ?></td>
                                    <td>
                                        <a href="/users/<?= $user['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                        <!-- <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i> Edit Role</a> -->
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>