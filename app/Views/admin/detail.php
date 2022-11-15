<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/users" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <?php if (session()->getFlashdata('roleUpdate')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('roleUpdate'); ?></div>
                <?php endif; ?>
                <h5 class="pb-2">Detail User</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <?php if ($detail == 1) : ?>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center mx-auto">
                                        <img src="/img/profile-img/<?= $user['profile_img']; ?>" alt="<?= $user['username']; ?>" class="card-img user-image rounded-circle border border-primary">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td><?= $user['username']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td><?= $user['full_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td><?= $user['email']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Role</th>
                                    <td>
                                        <?php if (in_groups(['Super admin', 'Owner'])) : ?>
                                            <form action="/users/editrole" method="post" class="d-inline">
                                                <select name="role_user" id="role_user" class="form-control custom-select">
                                                    <option>Pilih Role ...</option>
                                                    <?php foreach ($role as $role) : ?>
                                                        <option value="<?= $role['id']; ?>" <?= ($role['id'] == $user['roleid']) ? 'selected' : ''; ?>><?= $role['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                                <button type="submit" class="btn btn-sm btn-primary mt-1"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                            </form>
                                        <?php else : ?>
                                            <?= $user['role']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <?php if ($user['gender'] == 'l') : ?>
                                        <td>Laki-laki</td>
                                    <?php elseif ($user['gender'] == 'p') : ?>
                                        <td>Perempuan</td>
                                    <?php else : ?>
                                        <td>Belum diatur</td>
                                    <?php endif; ?>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat, Tgl. Lahir</th>
                                    <td><?= $user['tempat_lahir']; ?>, <?= $user['tgl_lahir']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td><?= $user['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Telepon</th>
                                    <td><?= $user['tel']; ?></td>
                                </tr>
                            </tbody>
                        <?php else : ?>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center mx-auto">
                                        <img src="/img/profile-img/<?= $user['profile_img']; ?>" alt="<?= $user['username']; ?>" class="card-img user-image rounded-circle border border-primary">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Username</th>
                                    <td><?= $user['username']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nama</th>
                                    <td><?= $user['full_name']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td><?= $user['email']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Role</th>
                                    <td>
                                        <?php if (in_groups(['Super admin', 'Owner'])) : ?>
                                            <form action="/users/editrole" method="post" class="d-inline">
                                                <input type="hidden" name="user_id" value="<?= $user['id']; ?>">
                                                <select name="role_user" id="role_user" class="form-control custom-select">
                                                    <option>Pilih Role ...</option>
                                                    <?php foreach ($role as $role) : ?>
                                                        <option value="<?= $role['id']; ?>" <?= ($role['id'] == $user['roleid']) ? 'selected' : ''; ?>><?= $role['name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-primary mt-1"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                            </form>
                                        <?php else : ?>
                                            <?= $user['role']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Jenis Kelamin</th>
                                    <td>Belum diatur</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tempat, Tgl. Lahir</th>
                                    <td>Belum diatur</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alamat</th>
                                    <td>Belum diatur</td>
                                </tr>
                                <tr>
                                    <th scope="row">Telepon</th>
                                    <td>Belum diatur</td>
                                </tr>
                            </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>