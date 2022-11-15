<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($aset_beli); ?> -->
<div class="row">
    <div class="col-lg-6">
        <?php if (session()->getFlashdata('aset')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('aset'); ?></div>
        <?php endif; ?>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="asetTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="aset-dibeli-tab" data-toggle="tab" href="#aset-dibeli" role="tab"><i class="fas fa-fw fa-people-carry"></i> Pembelian Aset</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="aset-aktif-tab" data-toggle="tab" href="#aset-aktif" role="tab"><i class="fas fa-fw fa-box"></i> Aset Aktif</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="aset-dijual-tab" data-toggle="tab" href="#aset-dijual" role="tab"><i class="fas fa-fw fa-file-invoice-dollar"></i> Aset Dijual</a>
    </li>
</ul>

<!-- Tab -->
<div class="tab-content">
    <!-- Aset dibeli -->
    <div class="tab-pane" id="aset-dibeli" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="/pembelianaset/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelBeliAset">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Aset</th>
                                        <th scope="col">Tgl. Pembelian</th>
                                        <th scope="col">Harga Pembelian</th>
                                        <th scope="col">Status Pembelian</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($aset_beli) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($aset_beli as $aset_beli_item) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $aset_beli_item['nama_aset']; ?></td>
                                                <td><?= $aset_beli_item['tgl_perolehan']; ?></td>
                                                <td>Rp. <?= number_format($aset_beli_item['harga_perolehan'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <?php if ($aset_beli_item['status_transaksi'] == '0') : ?>
                                                        <span class="badge badge-primary">Lunas - Belum diterima</span>
                                                    <?php elseif ($aset_beli_item['status_transaksi'] == '1') : ?>
                                                        <span class="badge badge-success">Lunas - Sudah diterima</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-danger">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="/pembelianaset/detail/<?= $aset_beli_item['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <?php if ($aset_beli_item['status_transaksi'] == '0') : ?>
                                                        <a href="/pembelianaset/edit/<?= $aset_beli_item['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary beli-aset-acc" data-beliaset-id="<?= $aset_beli_item['id']; ?>" data-aset-id="<?= $aset_beli_item['aset_id']; ?>"><i class="fas fa-fw fa-check"></i> Diterima?</a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger beli-aset-delete" data-beliaset-id="<?= $aset_beli_item['id']; ?>" data-aset-id="<?= $aset_beli_item['aset_id']; ?>" data-pengeluaran="<?= $aset_beli_item['pengeluaran_id']; ?>"><i class="fas fa-fw fa-times"></i> Batalkan</a>
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
    </div>
    <!-- Aset aktif -->
    <div class="tab-pane active" id="aset-aktif" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="/aset/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Aset</a>
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabelAset">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Aset</th>
                                        <th scope="col">Tgl. Perolehan</th>
                                        <th scope="col">Harga Perolehan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($aset) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($aset as $aset_item) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $aset_item['nama_aset']; ?></td>
                                                <td><?= $aset_item['tgl_perolehan']; ?></td>
                                                <td>Rp. <?= number_format($aset_item['harga_perolehan'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="/aset/detail/<?= $aset_item['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="/aset/edit/<?= $aset_item['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger aset-delete" data-aset-id="<?= $aset_item['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                                    <a href="/penjualanaset/add/<?= $aset_item['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-dollar-sign"></i> Jual</a>
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
    <!-- Aset dijual -->
    <div class="tab-pane" id="aset-dijual" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <a href="/aset/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Aset</a> -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="tabelAsetDijual">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Aset</th>
                                        <th scope="col">Tgl. Penjualan</th>
                                        <th scope="col">Harga Jual</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($aset_jual) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($aset_jual as $aset_jual_item) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $aset_jual_item['nama_aset']; ?></td>
                                                <td><?= $aset_jual_item['tgl_penjualan']; ?></td>
                                                <td>Rp. <?= number_format($aset_jual_item['harga_jual'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="/penjualanaset/detail/<?= $aset_jual_item['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
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

<!-- Modal Batal Beli Aset -->
<div class="modal fade" id="deleteBeliAsetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBeliAsetModalLabel">Batalkan Pembelian Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembelianaset/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin membatalkan pembelian aset ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pembelian_aset_id" class="pembelian_aset_id">
                    <input type="hidden" name="aset_id" class="aset_id">
                    <input type="hidden" name="pengeluaran_id" class="pengeluaran_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Kembali</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Terima Aset -->
<div class="modal fade" id="terimaAsetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="terimaAsetModalLabel">Konfirmasi Penerimaan Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembelianaset/accept" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p class="text-justify font-weight-bold">Apakah Anda yakin ingin menyelesaikan transaksi pembelian aset ini?</p>
                    <p class="text-justify">Pastikan aset yang diterima sudah sesuai. Transaksi yang sudah diselesaikan tidak dapat diubah lagi atau dihapus!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pembelian_aset_id" class="pembelian_aset_id">
                    <input type="hidden" name="aset_id" class="aset_id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Selesaikan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteAsetModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAsetModalLabel">Hapus Data Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/aset/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="aset_id" class="aset_id">
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
    // Tabel aset
    $(document).ready(function() {
        $('#tabelBeliAset').DataTable();
        $('#tabelAset').DataTable();
        $('#tabelAsetDijual').DataTable();
    });

    // Batalkan Pembelian Aset
    $('.beli-aset-delete').on('click', function() {
        // Ambil data btn delete
        const pembelian_aset_id = $(this).data('beliaset-id');
        const aset_id = $(this).data('aset-id');
        const pengeluaran_id = $(this).data('pengeluaran');
        // Set data ke form delete
        $('.pembelian_aset_id').val(pembelian_aset_id);
        $('.aset_id').val(aset_id);
        $('.pengeluaran_id').val(pengeluaran_id);
        // Panggil modal delete
        $('#deleteBeliAsetModal').modal('show');
    });

    // Delete Aset
    $('.aset-delete').on('click', function() {
        // Ambil data btn
        const id = $(this).data('aset-id');
        // Set data ke form delete
        $('.aset_id').val(id);
        // Panggil modal delete
        $('#deleteAsetModal').modal('show');
    });

    // Terima aset
    $('.beli-aset-acc').on('click', function() {
        // Ambil data btn
        const pembelian_aset_id = $(this).data('beliaset-id');
        const aset_id = $(this).data('aset-id');
        // Set data ke form delete
        $('.pembelian_aset_id').val(pembelian_aset_id);
        $('.aset_id').val(aset_id);
        // Panggil modal delete
        $('#terimaAsetModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>