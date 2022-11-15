<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('akuncat')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('akuncat'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <a href="/akun" class="btn btn-primary mb-3"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card mb-4">
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAkunCatModal"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelKategoriAkun">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori Akun</th>
                                <th scope="col">Kode Kategori Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if ($kategori) : ?>
                                <?php foreach ($kategori as $cat) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $cat['kategori_akun']; ?></td>
                                        <td><?= $cat['kode_kategori_akun']; ?></td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-warning akun-cat-edit" data-akuncat-id="<?= $cat['id']; ?>" data-akuncat-name="<?= $cat['kategori_akun']; ?>" data-akuncat-code="<?= $cat['kode_kategori_akun']; ?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger akun-cat-delete" data-akuncat-id="<?= $cat['id']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="addAkunCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAkunCatModalLabel">Tambah Kategori Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/akun/addcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori_akun">Kategori Akun</label>
                        <input type="text" class="form-control" name="nama_kategori_akun" id="nama_kategori_akun">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori_akun">Kode Kategori Akun</label>
                        <input type="text" class="form-control" name="kode_kategori_akun" id="kode_kategori_akun">
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
<div class="modal fade" id="editAkunCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAkunCatModalLabel">Edit Kategori Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/akun/editcategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori_akun">Kategori Akun</label>
                        <input type="text" class="form-control nama_kategori_akun" name="nama_kategori_akun" id="nama_kategori_akun">
                    </div>
                    <div class="form-group">
                        <label for="kode_kategori_akun">Kode Kategori Akun</label>
                        <input type="text" class="form-control kode_kategori_akun" name="kode_kategori_akun" id="kode_kategori_akun">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_akun_id" class="kategori_akun_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteAkunCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAkunCatModalLabel">Hapus Kategori Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/akun/deletecategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_akun_id" class="kategoriAkunID">
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
        // Tabel akun
        $('#tabelKategoriAkun').DataTable();

        // Edit
        $('.akun-cat-edit').on('click', function() {
            // Ambil data btn edit
            const id = $(this).data('akuncat-id');
            const nama = $(this).data('akuncat-name');
            const kode = $(this).data('akuncat-code');
            // Set data ke form edit
            $('.kategori_akun_id').val(id);
            $('.nama_kategori_akun').val(nama);
            $('.kode_kategori_akun').val(kode);
            // Panggil modal edit
            $('#editAkunCatModal').modal('show');
        });

        // Delete
        $('.akun-cat-delete').on('click', function() {
            // Ambil data btn delete
            const id = $(this).data('akuncat-id');
            // Set data ke form delete
            $('.kategoriAkunID').val(id);
            // Panggil modal delete
            $('#deleteAkunCatModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>