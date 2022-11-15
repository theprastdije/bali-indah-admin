<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('pendapatan')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pendapatan'); ?></div>
                <?php endif; ?>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Kas</h6>
            </div>
            <div class="card-body">
                <a href="/pendapatan/add" class="btn btn-info mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
                <div class="table-responsive">
                    <table class="table table-hover display" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Jenis Pendapatan</th>
                                <th scope="col">Rincian Pendapatan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if ($pendapatan) : ?>
                                <?php foreach ($pendapatan as $in) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td>
                                            <?php if ($in['kategori_pendapatan'] == "o") : ?>
                                                Operasional
                                            <?php elseif ($in['kategori_pendapatan'] == "i") : ?>
                                                Investasi
                                            <?php elseif ($in['kategori_pendapatan'] == "p") : ?>
                                                Pendanaan
                                            <?php else : ?>
                                                N/A
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $in['rincian_pendapatan']; ?></td>
                                        <td>Rp. <?= number_format($in['jumlah'], 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="/pendapatan/detail/<?= $in['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/pendapatan/edit/<?= $in['id']; ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btn-in-del" data-id="<?= $in['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
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
<div class="modal fade" id="deletePendapatanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePendapatanModalLabel">Hapus Data Pendapatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pendapatan/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pendapatan_id" class="pendapatan_id">
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
    // Delete Produk
    $('.btn-in-del').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('id');
        // Set data ke form delete
        $('.pendapatan_id').val(id);
        // Panggil modal delete
        $('#deletePendapatanModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>