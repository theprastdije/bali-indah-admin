<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('kas')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('kas'); ?></div>
                <?php endif; ?>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Kas</h6>
            </div>
            <div class="card-body">
                <a href="/kas/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Setor/Tarik Kas</a>
                <!-- <div class="row">
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Kas Tersedia</div>
                                        <div class="text font-weight-bold">Rp. 0</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-user-tag fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi -->
<!-- Tab -->
<ul class="nav nav-tabs" id="penjualanTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="kas-keluar-tab" data-toggle="tab" href="#kasKeluar" role="tab"><i class="fas fa-fw fa-hand-holding-usd"></i> Kas Keluar</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="kas-masuk-tab" data-toggle="tab" href="#kasMasuk" role="tab"><i class="fas fa-fw fa-hand-holding-usd"></i> Kas Masuk</a>
    </li>
</ul>

<!-- Konten tab -->
<div class="tab-content">
    <!-- Kas keluar -->
    <div class="tab-pane active" id="kasKeluar" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelKasKeluar">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Akun</th>
                                        <th scope="col">Tgl. Transaksi</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($kas_keluar) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kas_keluar as $kas_keluar) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $kas_keluar['kategori_akun']; ?>-<?= $kas_keluar['kode_akun']; ?> - <?= $kas_keluar['nama_akun']; ?></td>
                                                <td><?= $kas_keluar['tgl_kas_keluar']; ?></td>
                                                <td>Rp. <?= number_format($kas_keluar['jumlah'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="/kas/detailkaskeluar/<?= $kas_keluar['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="/kas/editkaskeluar/<?= $kas_keluar['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger kas-keluar-delete" data-kas-keluar="<?= $kas_keluar['id']; ?>" data-pengeluaran="<?= $kas_keluar['pengeluaran_id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
    <!-- Kas masuk -->
    <div class="tab-pane" id="kasMasuk" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelKasMasuk">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Akun</th>
                                        <th scope="col">Tgl. Transaksi</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($kas_masuk) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($kas_masuk as $kas_masuk) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $kas_masuk['kategori_akun']; ?>-<?= $kas_masuk['kode_akun']; ?> - <?= $kas_masuk['nama_akun']; ?></td>
                                                <td><?= $kas_masuk['tgl_kas_masuk']; ?></td>
                                                <td>Rp. <?= number_format($kas_masuk['jumlah'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="/kas/detailkasmasuk/<?= $kas_masuk['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="/kas/editkasmasuk/<?= $kas_masuk['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger kas-masuk-delete" data-kas-masuk="<?= $kas_masuk['id']; ?>" data-pendapatan="<?= $kas_masuk['pendapatan_id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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

<!-- Modal Delete Kas keluar -->
<div class="modal fade" id="deleteKasKeluarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteKasKeluarModalLabel">Hapus Data Kas Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/kas/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kas_keluar_id" class="kas_keluar_id">
                    <input type="hidden" name="pengeluaran_id" class="pengeluaran_id">
                    <input type="hidden" name="jenis_kas" class="jenis_kas" value="keluar">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete Kas masuk -->
<div class="modal fade" id="deleteKasMasukModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteKasMasukModalLabel">Hapus Data Kas Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/kas/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kas_masuk_id" class="kas_masuk_id">
                    <input type="hidden" name="pendapatan_id" class="pendapatan_id">
                    <input type="hidden" name="jenis_kas" class="jenis_kas" value="masuk">
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
    // Tabel kas keluar
    $(document).ready(function() {
        $('#tabelKasKeluar').DataTable();
    });
    // Tabel kas masuk
    $(document).ready(function() {
        $('#tabelKasMasuk').DataTable();
    });

    // Delete kas keluar
    $('.kas-keluar-delete').on('click', function() {
        // Ambil data btn delete
        const kas_keluar_id = $(this).data('kas-keluar');
        const pengeluaran_id = $(this).data('pengeluaran');
        // Set data ke form delete
        $('.kas_keluar_id').val(kas_keluar_id);
        $('.pengeluaran_id').val(pengeluaran_id);
        // Panggil modal delete
        $('#deleteKasKeluarModal').modal('show');
    });

    // Delete kas masuk
    $('.kas-masuk-delete').on('click', function() {
        // Ambil data btn delete
        const kas_masuk_id = $(this).data('kas-masuk');
        const pendapatan_id = $(this).data('pendapatan');
        // Set data ke form delete
        $('.kas_masuk_id').val(kas_masuk_id);
        $('.pendapatan_id').val(pendapatan_id);
        // Panggil modal delete
        $('#deleteKasMasukModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>