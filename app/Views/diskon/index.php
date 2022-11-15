<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12 mb-3">
        <a href="/pendapatan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('diskon')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('diskon'); ?></div>
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
                <a href="/diskon/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Diskon</a>
                <div class="row">
                    <?php if ($diskon_aktif) : ?>
                        <?php foreach ($diskon_aktif as $diskon_aktif) : ?>
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card border-left-primary h-100 p-0">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-sm font-weight-bold text-uppercase mb-1"><?= $diskon_aktif['nama_diskon']; ?></div>
                                                <div class="text-sm">Kode: <b><?= $diskon_aktif['kode_diskon']; ?></b></div>
                                                <div class="text-xs font-weight-bold"><?= $diskon_aktif['periode_awal_diskon']; ?> - <?= $diskon_aktif['periode_akhir_diskon']; ?></div>
                                                <a href="/diskon/detail/<?= $diskon_aktif['id']; ?>" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                                <a href="/diskon/edit/<?= $diskon_aktif['id']; ?>" class="px-1 mb-0 font-weight-bold">Edit &raquo;</a>
                                            </div>
                                            <div class="col-auto">
                                                <div class="h4 font-weight-bold">
                                                    <?php if ($diskon_aktif['satuan_diskon'] == 'persen') : ?>
                                                        <?= number_format($diskon_aktif['jumlah_diskon'], 0, ',', '.'); ?>%
                                                    <?php elseif ($diskon_aktif['satuan_diskon'] == 'jumlah') : ?>
                                                        Rp. <?= number_format($diskon_aktif['jumlah_diskon'], 0, ',', '.'); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="row mt-3 p-2">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabelDiskon">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Diskon</th>
                                        <th scope="col">Jumlah Diskon</th>
                                        <th scope="col">Periode Diskon</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($diskon) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($diskon as $diskon) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $diskon['nama_diskon']; ?></td>
                                                <td>
                                                    <?php if ($diskon['satuan_diskon'] == "jumlah") : ?>
                                                        Rp. <?= number_format($diskon['jumlah_diskon'], 2, ',', '.'); ?>
                                                    <?php elseif ($diskon['satuan_diskon'] == "persen") : ?>
                                                        <?= $diskon['jumlah_diskon']; ?>%
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $diskon['periode_awal_diskon']; ?>-<?= $diskon['periode_akhir_diskon']; ?></td>
                                                <td>
                                                    <a href="/diskon/detail/<?= $diskon['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="/diskon/edit/<?= $diskon['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger diskon-delete" data-diskon-id="<?= $diskon['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteDiskonModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDiskonModalLabel">Hapus Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/diskon/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus diskon ini? Diskon yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="diskon_id" class="diskon_id">
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
    // Tabel produk
    $(document).ready(function() {
        $('#tabelDiskon').DataTable();
    });

    // Delete produk
    $('.diskon-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('diskon-id');
        // Set data ke form delete
        $('.diskon_id').val(id);
        // Panggil modal delete
        $('#deleteDiskonModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>