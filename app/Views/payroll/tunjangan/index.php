<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= dd($tunjangan); ?> -->
<div class="row">
    <div class="col-12 mb-3">
        <a href="/payroll" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php if (session()->getFlashdata('tunjangan')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('tunjangan'); ?></div>
        <?php endif; ?>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Tunjangan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if ($tunjangan) : ?>
                        <?php foreach ($tunjangan as $tunjangan) : ?>
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-sm font-weight-bold text-uppercase mb-1"><?= $tunjangan['jenis_tunjangan']; ?></div>
                                                <a href="/tunjangan/detail/<?= $tunjangan['id']; ?>" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-fw fa-user-tag fa-2x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="h6 font-weight-bold px-3">Data jenis tunjangan tidak tersedia. Silakan tambahkan terlebih dahulu</div>
                    <?php endif; ?>
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
            <form action="/tunjangan/delete" method="post">
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