<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($penjualan, $order); ?> -->
<!-- <div class="row">
    <div class="col-12 mb-3">
        <a href="/pendapatan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div> -->

<div class="row">
    <div class="col-6">
        <?php if (session()->getFlashdata('penjualan')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('penjualan'); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Produk dan Diskon</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Kelola Penjualan</div>
                                        <a href="/penjualan/add" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-dollar-sign fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Produk</div>
                                        <a href="/produk" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-tag fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Diskon</div>
                                        <a href="/diskon" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-percent fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Laporan Penjualan</div>
                                        <a href="/penjualan/laporan" class="generate-laporan mb-0 font-weight-bold">Lihat &raquo;</a>
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

<!-- Nav tabs -->
<ul class="nav nav-tabs" id="asetTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="penjualan-tab" data-toggle="tab" href="#penjualan" role="tab"><i class="fas fa-fw fa-dollar-sign"></i> Penjualan</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="order-tab" data-toggle="tab" href="#order" role="tab"><i class="fas fa-fw fa-file-invoice-dollar"></i> Belum Lunas</a>
    </li>
</ul>

<div class="tab-content">
    <!-- Penjualan -->
    <div class="tab-pane active" id="penjualan" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="penjualanTabel">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tgl. Order</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($penjualan) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($penjualan as $jual_lunas) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $jual_lunas['tgl_transaksi']; ?></td>
                                                <td><?= $jual_lunas['nama_customer']; ?></td>
                                                <td>Rp. <?= number_format($jual_lunas['total_belanja'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <?php if ($jual_lunas['status_pembayaran'] == 'lunas') : ?>
                                                        <span class="badge badge-success">Lunas</span>
                                                    <?php elseif ($jual_lunas['status_pembayaran'] == 'selesai') : ?>
                                                        <span class="badge badge-primary">Lunas - Sudah Main</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-secondary">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="/penjualan/detail/<?= $jual_lunas['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <?php if (in_groups(['Super admin', 'Owner'])) : ?>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-sales-del"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
    <!-- Order -->
    <div class="tab-pane" id="order" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="orderTabel">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tgl. Order</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($order) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($order as $order_produk) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $order_produk['tgl_transaksi']; ?></td>
                                                <td><?= $order_produk['nama_customer']; ?></td>
                                                <td>Rp. <?= number_format($order_produk['total_belanja'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <?php if ($order_produk['status_pembayaran'] == 'order') : ?>
                                                        <span class="badge badge-danger">Order/Belum lunas</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-secondary">N/A</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="/penjualan/detail/<?= $order_produk['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-bayar" data-order-id="<?= $order_produk['id']; ?>" data-pendapatan-id="<?= $order_produk['pendapatan_id']; ?>" data-total-belanja="<?= $order_produk['total_belanja']; ?>" data-jml-bayar="<?= $order_produk['jumlah_pembayaran']; ?>"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</a>
                                                    <?php if (in_groups(['Super admin', 'Owner'])) : ?>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-sales-del"><i class="fas fa-fw fa-trash"></i> Hapus</a>
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
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deletePenjualanModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePenjualanModalLabel">Hapus Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/penjualan/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="penjualan_id" class="penjualanID">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Bayar -->
<div class="modal fade" id="bayarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarModalLabel">Bayar Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/penjualan/bayarorder" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="input-group">
                        <label for="total_belanja" class="col-form-label col-12">Total Belanja</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="total_belanja" id="total_belanja" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label for="jumlah_bayar" class="col-form-label col-12">Jumlah yang Sudah Dibayar</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="jumlah_bayar" id="jumlah_bayar" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label for="bayar" class="col-form-label col-12">Jumlah Pembayaran</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="bayar" id="bayar" placeholder="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="penjualan_id" class="penjualan_id">
                    <input type="hidden" name="pendapatan_id" class="pendapatan_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Script untuk kelola penjualan
    $(document).ready(function() {
        $('#penjualanTabel').DataTable();
        $('#orderTabel').DataTable();

        // Delete Penjualan
        $('.btn-sales-del').on('click', function() {
            // Ambil data btn sales del
            const id = $(this).data('id');
            // Set data ke form delete
            $('.penjualanID').val(id);
            // Panggil modal delete
            $('#deletePenjualanModal').modal('show');
        });

        $('.btn-bayar').on('click', function() {
            // Ambil data btn bayar
            const penjualan_id = $(this).data('order-id');
            const pendapatan_id = $(this).data('pendapatan-id');
            const total_belanja = $(this).data('total-belanja');
            const jml_bayar = $(this).data('jml-bayar');
            // Set data ke form
            $('.penjualan_id').val(penjualan_id);
            $('.pendapatan_id').val(pendapatan_id);
            $('#total_belanja').val(total_belanja);
            $('#jumlah_bayar').val(jml_bayar);
            // Panggil modal
            $('#bayarModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>