<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12 mb-3">
        <a href="/payroll" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('gaji')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('gaji'); ?></div>
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
                <a href="/gaji/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Penerima Gaji</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelGaji">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Staf</th>
                                <th scope="col">Jumlah Gaji Per Bulan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($gaji) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($gaji as $gaji) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $gaji['nama_staf']; ?></td>
                                        <td>Rp. <?= number_format($gaji['jumlah_gaji'], 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="/gaji/detail/<?= $gaji['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail dan Pembayaran</a>
                                            <a href="/gaji/edit/<?= $gaji['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger gaji-delete" data-gaji-id="<?= $gaji['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
<div class="modal fade" id="deleteGajiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGajiModalLabel">Hapus Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/gaji/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data gaji ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="gaji_id" class="gaji_id">
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
    // Tabel gaji
    $(document).ready(function() {
        $('#tabelGaji').DataTable();
    });

    // Delete gaji
    $('.gaji-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('gaji-id');
        // Set data ke form delete
        $('.gaji_id').val(id);
        // Panggil modal delete
        $('#deleteGajiModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>