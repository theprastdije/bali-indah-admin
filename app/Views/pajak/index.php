<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('pajak')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pajak'); ?></div>
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
                <a href="/pajak/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelPajak">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Pajak</th>
                                <th scope="col">Kode Akun</th>
                                <th scope="col">Tarif Pajak</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($pajak) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($pajak as $pajak) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $pajak['jenis_pajak']; ?></td>
                                        <td><?= $pajak['kategori_akun']; ?>-<?= $pajak['kode_akun']; ?></td>
                                        <td><?= $pajak['tarif_pajak']; ?>%</td>
                                        <td>
                                            <a href="/pajak/detail/<?= $pajak['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/pajak/edit/<?= $pajak['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger pajak-delete" data-pajak-id="<?= $pajak['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
<div class="modal fade" id="deletePajakModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePajakModalLabel">Hapus Pajak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pajak/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jenis pajak ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pajak_id" class="pajak_id">
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
        $('#tabelPajak').DataTable();
    });

    // Delete jenis pembayaran
    $('.pajak-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('pajak-id');
        // Set data ke form delete
        $('.pajak_id').val(id);
        // Panggil modal delete
        $('#deletePajakModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>