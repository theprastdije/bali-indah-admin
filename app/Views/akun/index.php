<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('akun')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('akun'); ?></div>
                <?php endif; ?>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <a href="/akun/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                <a href="/akun/category" class="btn btn-primary mb-3"><i class="fas fa-fw fa-cog"></i> Kelola Kategori</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelAkun">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori Akun</th>
                                <th scope="col">Nama Akun</th>
                                <th scope="col">Kode Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if ($akun) : ?>
                                <?php foreach ($akun as $acc) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $acc['kategori_akun']; ?></td>
                                        <td><?= $acc['nama_akun']; ?></td>
                                        <td><?= $acc['kode_kategori_akun']; ?>-<?= $acc['kode_akun']; ?></td>
                                        <td>
                                            <a href="/akun/edit/<?= $acc['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger akun-delete" data-akun-id="<?= $acc['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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


<!-- Modal Delete -->
<div class="modal fade" id="deleteAkunModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAkunModalLabel">Hapus Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/akun/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus akun ini? Akun yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="akun_id" class="akun_id">
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
    // Tabel akun
    $(document).ready(function() {
        $('#tabelAkun').DataTable();
    });

    // Delete Akun
    $('.akun-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('akun-id');
        console.log(id)
        // Set data ke form delete
        $('.akun_id').val(id);
        // Panggil modal delete
        $('#deleteAkunModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>