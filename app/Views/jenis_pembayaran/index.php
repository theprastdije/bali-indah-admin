<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('pembayaran')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pembayaran'); ?></div>
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
                <a href="/pembayaran/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelPembayaran">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Jenis Pembayaran</th>
                                <th scope="col">Kode Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($pembayaran) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($pembayaran as $pembayaran) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $pembayaran['nama_jenis_pembayaran']; ?></td>
                                        <td><?= $pembayaran['kategori_akun']; ?>-<?= $pembayaran['kode_akun']; ?></td>
                                        <td>
                                            <a href="/pembayaran/detail/<?= $pembayaran['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/pembayaran/edit/<?= $pembayaran['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger bayar-delete" data-bayar-id="<?= $pembayaran['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
<div class="modal fade" id="deletePembayaranModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePembayaranModalLabel">Hapus Jenis Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembayaran/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jenis pembayaran ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_pembayaran_id" class="jenis_pembayaran_id">
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
    // Tabel jenis pembayaran
    $(document).ready(function() {
        $('#tabelPembayaran').DataTable();
    });

    // Delete jenis pembayaran
    $('.bayar-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('bayar-id');
        // Set data ke form delete
        $('.jenis_pembayaran_id').val(id);
        // Panggil modal delete
        $('#deletePembayaranModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>