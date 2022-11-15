<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <?= d($pengajuan_manajer); ?> -->
<!-- Notifikasi -->
<div class="row">
    <div class="col-lg-6">
        <?php if (session()->getFlashdata('pengeluaran')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pengeluaran'); ?></div>
        <?php endif; ?>
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

<?php if (in_groups(['Super admin', 'Owner', 'Manajer', 'Kasir'])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-1">
                            <div class="card h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-sm font-weight-bold text-uppercase mb-1">Laporan Pengeluaran</div>
                                            <a href="/pengeluaran/laporan" class="generate-laporan mb-0 font-weight-bold">Lihat &raquo;</a>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-file-invoice-dollar fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Tab -->
<ul class="nav nav-tabs" id="penjualanTab" role="tablist">
    <?php if (in_groups(['Super admin', 'Owner', 'Manajer', 'Kasir'])) : ?>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="keperluan-tab" data-toggle="tab" href="#keperluan" role="tab"><i class="fas fa-fw fa-file-invoice-dollar"></i> Keperluan Harian</a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link" id="beli-aset-tab" data-toggle="tab" href="#beliAset" role="tab"><i class="fas fa-fw fa-people-carry"></i> Pembelian Aset</a>
        </li> -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="list-pengajuan-tab" data-toggle="tab" href="#cekPengajuan" role="tab"><i class="fas fa-fw fa-file-invoice-dollar"></i> List Pengajuan</a>
        </li>
    <?php endif; ?>
    <?php if (in_groups(['Super admin', 'Staf'])) : ?>
        <li class="nav-item" role="presentation">
            <a class="nav-link <?= (in_groups('Staf')) ? 'active' : ''; ?>" id="pengajuan-tab" data-toggle="tab" href="#pengajuan" role="tab"><i class="fas fa-fw fa-file-invoice-dollar"></i> Pengajuan Pengeluaran</a>
        </li>
    <?php endif; ?>
</ul>

<!-- Konten tab -->
<div class="tab-content">
    <?php if (in_groups(['Super admin', 'Owner', 'Manajer', 'Kasir'])) : ?>
        <!-- Keperluan harian -->
        <div class="tab-pane active" id="keperluan" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="/pengeluaran/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive p-1">
                                <table class="table table-hover" id="tabelKeperluanHarian">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tgl. Transaksi</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Total Belanja</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($harian) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($harian as $harian) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= $harian['tgl_transaksi']; ?></td>
                                                    <td><?= $harian['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($harian['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td>
                                                        <a href="/pengeluaran/detail/<?= $harian['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                        <a href="/pengeluaran/edit/<?= $harian['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger belanja-delete" data-belanja-id="<?= $harian['id']; ?>" data-pengeluaran="<?= $harian['pengeluaran_id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
        <!-- Pembelian aset -->
        <!-- <div class="tab-pane" id="beliAset" role="tabpanel">
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
                                        <?php if ($aset) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($aset as $beli_aset) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= $beli_aset['nama_aset']; ?></td>
                                                    <td><?= $beli_aset['tgl_perolehan']; ?></td>
                                                    <td>Rp. <?= number_format($beli_aset['harga_perolehan'], 2, ',', '.'); ?></td>
                                                    <td>
                                                        <?php if ($beli_aset['status_transaksi'] == '0') : ?>
                                                            <span class="badge badge-primary">Lunas - Belum diterima</span>
                                                        <?php elseif ($beli_aset['status_transaksi'] == '1') : ?>
                                                            <span class="badge badge-success">Lunas - Sudah diterima</span>
                                                        <?php else : ?>
                                                            <span class="badge badge-danger">N/A</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="/pembelianaset/detail/<?= $beli_aset['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                        <?php if ($beli_aset['status_transaksi'] == '0') : ?>
                                                            <a href="/pembelianaset/edit/<?= $beli_aset['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-primary beli-aset-acc" data-beliaset-id="<?= $beli_aset['id']; ?>" data-aset-id="<?= $beli_aset['aset_id']; ?>"><i class="fas fa-fw fa-check"></i> Diterima?</a>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger beli-aset-delete" data-beliaset-id="<?= $beli_aset['id']; ?>" data-pengeluaran="<?= $beli_aset['pengeluaran_id']; ?>"><i class="fas fa-fw fa-times"></i> Batalkan</a>
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
        </div> -->
        <!-- List pengajuan keperluan -->
        <div class="tab-pane" id="cekPengajuan" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-hover" id="tabelCekPengajuan">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tgl. Transaksi</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Total Belanja</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($pengajuan_manajer) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($pengajuan_manajer as $pengajuan_manajer) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= $pengajuan_manajer['tgl_transaksi']; ?></td>
                                                    <td><?= $pengajuan_manajer['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($pengajuan_manajer['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td>
                                                        <a href="/pengajuan/detail/<?= $pengajuan_manajer['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-acc" data-id="<?= $pengajuan_manajer['id']; ?>"><i class="fas fa-fw fa-check"></i> Terima</a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-dec" data-id="<?= $pengajuan_manajer['id']; ?>"><i class="fas fa-fw fa-times"></i> Tolak</a>
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
    <?php endif; ?>
    <?php if (in_groups(['Super admin', 'Staf'])) : ?>
        <!-- Pengajuan oleh staf -->
        <div class="tab-pane <?= (in_groups('Staf')) ? 'active' : ''; ?>" id="pengajuan" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="/pengajuan/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive p-1">
                                <table class="table table-hover" id="tabelPengajuan">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tgl. Transaksi</th>
                                            <th scope="col">Keperluan</th>
                                            <th scope="col">Total Belanja</th>
                                            <th scope="col">Status Pengajuan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($pengajuan) : ?>
                                            <?php $i = 1; ?>
                                            <?php foreach ($pengajuan as $pengajuan) : ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= $pengajuan['tgl_transaksi']; ?></td>
                                                    <td><?= $pengajuan['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($pengajuan['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td>
                                                        <?php if ($pengajuan['status_pengajuan'] == '0') : ?>
                                                            <span class="badge badge-secondary">Diproses</span>
                                                        <?php elseif ($pengajuan['status_pengajuan'] == '1') : ?>
                                                            <span class="badge badge-success">Diterima</span>
                                                        <?php elseif ($pengajuan['status_pengajuan'] == '2') : ?>
                                                            <span class="badge badge-danger">Ditolak</span>
                                                        <?php else : ?>
                                                            <span class="badge badge-secondary">Tidak valid</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <a href="/pengajuan/detail/<?= $pengajuan['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                        <?php if ($pengajuan['status_pengajuan'] != '1') : ?>
                                                            <a href="/pengajuan/edit/<?= $pengajuan['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger pengajuan-delete" data-pengajuan-id="<?= $pengajuan['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                                        <?php endif; ?>
                                                        <?php if (in_groups(['Super admin', 'Owner']) && $pengajuan['status_pengajuan'] == '1') : ?>
                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger pengajuan-delete" data-pengajuan-id="<?= $pengajuan['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
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
    <?php endif; ?>
</div>

<!-- Modal Terima Pengajuan -->
<div class="modal fade" id="accPengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accPengajuanModalLabel">Terima Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/submit" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menerima pengajuan ini? Aksi tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <input type="hidden" name="status_pengajuan" class="status_pengajuan" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tolak Pengajuan -->
<div class="modal fade" id="decPengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="decPengajuanModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/submit" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menolak pengajuan ini? Aksi tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <input type="hidden" name="status_pengajuan" class="status_pengajuan" value="2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Pengajuan -->
<div class="modal fade" id="deletePengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePengajuanModalLabel">Hapus Pengajuan Pengeluaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete Pengeluaran Harian -->
<div class="modal fade" id="deleteBelanjaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBelanjaModalLabel">Hapus Data Pengeluaran</h5>
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
                    <input type="hidden" name="pengeluaran_id" class="pengeluaran_id">
                    <input type="hidden" name="pengeluaran_harian_id" class="pengeluaran_harian_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
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
                    <input type="hidden" name="pengeluaran_id" class="pengeluaran_id">
                    <input type="hidden" name="pengeluaran_harian_id" class="pengeluaran_harian_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        // Tabel keperluan harian
        $('#tabelKeperluanHarian').DataTable();
        // Tabel pembelian aset
        $('#tabelBeliAset').DataTable();
        // Tabel pengajuan
        $('#tabelPengajuan').DataTable();
        // Tabel cek pengajuan
        $('#tabelCekPengajuan').DataTable();
    });

    $('.btn-acc').on('click', function() {
        // Ambil data btn
        const pengajuan_id = $(this).data('id');
        // Set data ke form
        $('.pengajuan_id').val(pengajuan_id);
        // Terima pengajuan
        $('#accPengajuanModal').modal('show');
    });

    $('.btn-dec').on('click', function() {
        // Ambil data btn
        const pengajuan_id = $(this).data('id');
        // Set data ke form
        $('.pengajuan_id').val(pengajuan_id);
        // Tolak pengajuan
        $('#decPengajuanModal').modal('show');
    });

    // Delete pengajuan
    $('.pengajuan-delete').on('click', function() {
        // Ambil data btn delete
        const pengajuan_id = $(this).data('pengajuan-id');
        // Set data ke form delete
        $('.pengajuan_id').val(pengajuan_id);
        // Panggil modal delete
        $('#deletePengajuanModal').modal('show');
    });

    // Delete pengeluaran harian
    $('.belanja-delete').on('click', function() {
        // Ambil data btn delete
        const pengeluaran_harian_id = $(this).data('belanja-id');
        const pengeluaran_id = $(this).data('pengeluaran');
        // Set data ke form delete
        $('.pengeluaran_harian_id').val(pengeluaran_harian_id);
        $('.pengeluaran_id').val(pengeluaran_id);
        // Panggil modal delete
        $('#deleteBelanjaModal').modal('show');
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