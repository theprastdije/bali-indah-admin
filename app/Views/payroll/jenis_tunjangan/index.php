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
                <?php if (session()->getFlashdata('jenis_tunjangan')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('jenis_tunjangan'); ?></div>
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
                <a href="/tunjangan/addjenis" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelJenisTunjangan">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Akun Tunjangan</th>
                                <th scope="col">Jenis Tunjangan</th>
                                <th scope="col">Jumlah Tunjangan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($jenis_tunjangan) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($jenis_tunjangan as $jenis_tunjangan) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $jenis_tunjangan['kategori_akun']; ?>-<?= $jenis_tunjangan['kode_akun']; ?></td>
                                        <td><?= $jenis_tunjangan['jenis_tunjangan']; ?></td>
                                        <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="/tunjangan/detailjenis/<?= $jenis_tunjangan['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/tunjangan/editjenis/<?= $jenis_tunjangan['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger jenis-tjg-delete" data-jenis-tjg-id="<?= $jenis_tunjangan['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                            <?php if ($jenis_tunjangan['status_tunjangan'] == 1) : ?>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger jenis-tjg-disable" data-jenis-tjg-id="<?= $jenis_tunjangan['id']; ?>"><i class=" fas fa-fw fa-times"></i> Nonaktifkan</a>
                                            <?php else : ?>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success jenis-tjg-enable" data-jenis-tjg-id="<?= $jenis_tunjangan['id']; ?>"><i class=" fas fa-fw fa-check"></i> Aktifkan</a>
                                            <?php endif; ?>
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
<div class="modal fade" id="deleteJenisTjgModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJenisTjgModalLabel">Hapus Jenis Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tunjangan/deletejenis" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jenis tunjangan ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_tunjangan_id" class="jenis_tunjangan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Nonaktifkan Jenis Tjg -->
<div class="modal fade" id="deactivateTjgModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deactivateTjgModalLabel">Nonaktifkan Jenis Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tunjangan/deactivate" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menonaktifkan jenis tunjangan ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_tunjangan_id" class="jenis_tunjangan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-check"></i> Nonaktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Aktifkan Jenis Tjg -->
<div class="modal fade" id="activateTjgModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="activateTjgModalLabel">Aktifkan Jenis Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tunjangan/activate" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengaktifkan jenis tunjangan ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="jenis_tunjangan_id" class="jenis_tunjangan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Aktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Tabel jenis tunjangan
    $(document).ready(function() {
        $('#tabelJenisTunjangan').DataTable();
    });

    // Delete jenis tunjangan
    $('.jenis-tjg-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('jenis-tjg-id');
        // Set data ke form delete
        $('.jenis_tunjangan_id').val(id);
        // Panggil modal delete
        $('#deleteJenisTjgModal').modal('show');
    });

    // Disable jenis tunjangan
    $('.jenis-tjg-disable').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('jenis-tjg-id');
        // Set data ke form delete
        $('.jenis_tunjangan_id').val(id);
        // Panggil modal
        $('#deactivateTjgModal').modal('show');
    });

    // Enable jenis tunjangan
    $('.jenis-tjg-enable').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('jenis-tjg-id');
        // Set data ke form delete
        $('.jenis_tunjangan_id').val(id);
        // Panggil modal
        $('#activateTjgModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>