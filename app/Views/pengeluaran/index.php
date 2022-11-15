<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>

<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-6">
                <?php if (session()->getFlashdata('pengeluaran')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pengeluaran'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Pengeluaran</h6>
            </div>
            <div class="card-body">
                <a href="/pengeluaran/add" class="btn btn-info mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
                <a href="/pengeluaran/import" class="btn btn-info mb-3"><i class="fas fa-fw fa-plus"></i> Impor Data</a>
                <a href="/pengeluaran/category" class="btn btn-info mb-3"><i class="fas fa-fw fa-cog"></i> Kelola Kategori</a>
                <div class="table-responsive">
                    <table class="table display" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tgl. Transaksi</th>
                                <th scope="col">Rincian Pengeluaran</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if ($pengeluaran) : ?>
                                <?php foreach ($pengeluaran as $ex) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $ex['tgl_transaksi']; ?></td>
                                        <td><?= $ex['rincian_pengeluaran']; ?></td>
                                        <td>Rp. <?= number_format($ex['total_harga'], 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="/pengeluaran/detail/<?= $ex['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/pengeluaran/edit/<?= $ex['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-ex-del" data-id="<?= $ex['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteExModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteExModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengeluaran/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengeluaran_id" class="pengeluaranID">
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
    // Script untuk kelola pengeluaran
    $(document).ready(function() {
        // Delete
        $('.btn-ex-del').on('click', function() {
            // Ambil data btn ex del
            const id = $(this).data('id');
            // Set data ke form delete
            $('.pengeluaranID').val(id);
            // Panggil modal delete
            $('#deleteExModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>