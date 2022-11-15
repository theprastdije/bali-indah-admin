<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('outcategory')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('outcategory'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <a href="/pengeluaran" class="btn btn-info mb-3 mr-2"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <a href="javascript:void(0)" class="btn btn-info mb-3" data-toggle="modal" data-target="#addCatModal"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Kode Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori as $kategori) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $kategori['nama_kategori']; ?></td>
                                    <td><?= $kategori['kode_kategori']; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-edit" data-id="<?= $kategori['id']; ?>" data-name="<?= $kategori['nama_kategori']; ?>" data-code="<?= $kategori['kode_kategori']; ?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete" data-id="<?= $kategori['id']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="addCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCatModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengeluaran/addcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" id="nama_kategori">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">Kode Kategori</label>
                        <input type="text" class="form-control" name="kode_kategori" id="kode_kategori">
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

<!-- Modal Edit -->
<div class="modal fade" id="editCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCatModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengeluaran/editcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control nama_kategori" name="nama_kategori" id="nama_kategori">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">Kode Kategori</label>
                        <input type="text" class="form-control kode_kategori" name="kode_kategori" id="kode_kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_id" class="kategori_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCatModalLabel">Hapus Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengeluaran/deletecategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_id" class="kategoriID">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>