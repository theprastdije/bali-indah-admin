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
                <?php if (session()->getFlashdata('incategory')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('incategory'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <a href="/produk" class="btn btn-primary mb-3 mr-2"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card mb-4">
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProdCatModal"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori Produk</th>
                                <th scope="col">Kode Akun</th>
                                <th scope="col">Kode Kategori</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($kategori as $kategori) : ?>
                                <tr>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $kategori['nama_kategori_produk']; ?></td>
                                    <td></td>
                                    <td><?= $kategori['kode_kategori_produk']; ?></td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning prod-cat-edit" data-prodcat-id="<?= $kategori['id']; ?>" data-prodcat-name="<?= $kategori['nama_kategori_produk']; ?>" data-prodcat-code="<?= $kategori['kode_kategori_produk']; ?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger prod-cat-delete" data-prodcat-id="<?= $kategori['id']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="addProdCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProdCatModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/produk/addcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori_produk">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori_produk" id="nama_kategori_produk">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">Kode Kategori</label>
                        <input type="text" class="form-control" name="kode_kategori_produk" id="kode_kategori_produk">
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
<div class="modal fade" id="editProdCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProdCatModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/produk/editcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control nama_kategori_produk" name="nama_kategori_produk" id="nama_kategori_produk">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori">Kode Kategori</label>
                        <input type="text" class="form-control kode_kategori_produk" name="kode_kategori_produk" id="kode_kategori_produk">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_produk_id" class="kategori_produk_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteProdCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProdCatModalLabel">Hapus Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/produk/deletecategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_produk_id" class="kategoriProdukID">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        // Edit
        $('.prod-cat-edit').on('click', function() {
            // Ambil data btn edit
            const id = $(this).data('prodcat-id');
            const nama = $(this).data('prodcat-name');
            const kode = $(this).data('prodcat-code');
            // Set data ke form edit
            $('.kategori_produk_id').val(id);
            $('.nama_kategori_produk').val(nama);
            $('.kode_kategori_produk').val(kode);
            // Panggil modal edit
            $('#editProdCatModal').modal('show');
        });

        // Delete
        $('.prod-cat-delete').on('click', function() {
            // Ambil data btn delete
            const id = $(this).data('prodcat-id');
            // Set data ke form delete
            $('.kategoriProdukID').val(id);
            // Panggil modal delete
            $('#deleteProdCatModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>