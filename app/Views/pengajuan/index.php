<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<?php if (in_groups(['Super admin', 'Manajer', 'Owner'])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <?php if (session()->getFlashdata('pengajuan_admin')) : ?>
                        <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pengajuan_admin'); ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('pengajuan_admin_error')) : ?>
                        <div class="alert alert-danger"><i class="fas fa-fw fa-times-circle"></i> <?= session()->getFlashdata('pengajuan_admin_error'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-left-warning py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengajuan Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_pending; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-left-primary py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Belum Lengkap</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_kurang; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2 mx-lg-1">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Pengeluaran yang Diajukan (Manajer/Owner)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover display" id="dataTable">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Tgl. Pengajuan</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1 ?>
                                <?php if ($pengajuan_admin) : ?>
                                    <?php foreach ($pengajuan_admin as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $p['created_at']; ?></td>
                                            <td><?= $p['rincian_pengeluaran']; ?></td>
                                            <td>Rp. <?= number_format($p['total_harga'], 2, ',', '.'); ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td>
                                                <?php if ($p['status_pengajuan'] == 0) : ?>
                                                    <span class="badge badge-warning text-dark">Pending</span>
                                                <?php elseif ($p['status_pengajuan'] == 1) : ?>
                                                    <span class="badge badge-primary">Disetujui <br> Belum lengkap</span>
                                                <?php elseif ($p['status_pengajuan'] == 2) : ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php elseif ($p['status_pengajuan'] == 3) : ?>
                                                    <span class="badge badge-success">Disetujui</span>
                                                <?php else : ?>
                                                    <p>???</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?= dd($p['id']); ?>
                                                <a href="/pengajuan/detail/<?= $p['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                                <?php if ($p['status_pengajuan'] == 0) : ?>
                                                    <a class="btn btn-sm btn-success submit-accept" href="javascript:void(0)" data-id="<?= $p['id']; ?>"><i class="fas fa-fw fa-check"></i> Terima</a>
                                                    <a class="btn btn-sm btn-danger submit-decline" href="javascript:void(0)" data-id="<?= $p['id']; ?>"><i class="fas fa-fw fa-times"></i> Tolak</a>
                                                <?php endif; ?>
                                                <?php if ($p['status_pengajuan'] == 1) : ?>
                                                    <a class="btn btn-sm btn-primary submit-finish" href="javascript:void(0)" data-id="<?= $p['id']; ?>"><i class="fas fa-fw fa-check"></i> Lengkap?</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (in_groups(['Super admin', 'Staf', 'Kasir'])) : ?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <?php if (session()->getFlashdata('pengajuan_user')) : ?>
                        <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('pengajuan_user'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-left-warning py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengajuan Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_pending; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <div class="card border-left-primary py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Belum Lengkap</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_kurang; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-2 mx-lg-1">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">List Pengajuan Pengeluaran (Staf/Kasir)</h6>
                </div>
                <div class="card-body">
                    <a href="/pengajuan/add" class="btn btn-info mb-3"><i class="fas fa-fw fa-plus"></i> Ajukan Pengeluaran</a>
                    <div class="table-responsive">
                        <table class="table table-hover display" id="dataTables">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">Tgl. Pengajuan</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if ($pengajuan) : ?>
                                    <?php foreach ($pengajuan as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $p['created_at']; ?></td>
                                            <td><?= $p['rincian_pengeluaran']; ?></td>
                                            <td>Rp. <?= number_format($p['total_harga'], 2, ',', '.'); ?></td>
                                            <td><?= $p['keterangan']; ?></td>
                                            <td>
                                                <?php if ($p['status_pengajuan'] == 0) : ?>
                                                    <span class="badge badge-warning text-dark">Pending</span>
                                                <?php elseif ($p['status_pengajuan'] == 1) : ?>
                                                    <span class="badge badge-primary">Disetujui <br> Belum lengkap</span>
                                                <?php elseif ($p['status_pengajuan'] == 2) : ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php elseif ($p['status_pengajuan'] == 3) : ?>
                                                    <span class="badge badge-success">Disetujui</span>
                                                <?php else : ?>
                                                    <p>???</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="/pengajuan/detail/<?= $p['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                                                <?php if ($p['status_pengajuan'] == 0 || $p['status_pengajuan'] == 1) : ?>
                                                    <a href="/pengajuan/edit/<?= $p['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                                <?php endif; ?>
                                                <?php if ($p['status_pengajuan'] == 0 || $p['status_pengajuan'] == 2) : ?>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger submit-delete" data-id="<?= $p['id']; ?>"><i class="fas fa-fw fa-times"></i> Batalkan</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>

<?php endif; ?>

<!-- Modal Batalkan Pengajuan -->
<div class="modal fade" id="deletePengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePengajuanModalLabel">Batalkan Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin membatalkan pengajuan ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Kembali</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Batalkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Terima Pengajuan -->
<div class="modal fade" id="terimaPengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="terimaPengajuanModalLabel">Terima Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/submit" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menerima pengajuan ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <input type="hidden" name="status_pengajuan" id="status_pengajuan" value="1">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tidak</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tolak Pengajuan -->
<div class="modal fade" id="tolakPengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tolakPengajuanModalLabel">Tolak Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/submit" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menolak pengajuan ini?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <input type="hidden" name="status_pengajuan" id="status_pengajuan" value="2">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tidak</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Fix Pengajuan -->
<div class="modal fade" id="finishPengajuanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finishPengajuanModalLabel">Selesaikan Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pengajuan/submit" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menyelesaikan pengajuan ini? Aksi ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pengajuan_id" class="pengajuan_id">
                    <input type="hidden" name="status_pengajuan" id="status_pengajuan" value="3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tidak</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Terima pengajuan
    $('.submit-accept').on('click', function() {
        // Ambil data btn
        const pengajuan_id = $(this).data('id');
        // Set data ke form
        $('.pengajuan_id').val(pengajuan_id);
        // Panggil modal
        $('#terimaPengajuanModal').modal('show');
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
</script>
<?= $this->endSection(); ?>