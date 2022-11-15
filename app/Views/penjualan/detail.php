<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<a href="/penjualan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">Data Customer</th>
                                <th scope="col">Data Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span><strong>Nama Customer: </strong><?= $order['nama_customer']; ?></span>
                                </td>
                                <td>
                                    <span><strong>Tgl. Order: </strong><?= $order['tgl_order']; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><strong>Order ID: </strong><?= $order['id']; ?></span>
                                </td>
                                <td>
                                    <span><strong>Status Pembayaran: </strong></span>
                                    <?php if ($order['status'] == 'order') : ?>
                                        <span class="badge badge-danger">Menunggu pelunasan</span>
                                    <?php elseif ($order['status'] == 'paid') : ?>
                                        <span class="badge badge-primary">Lunas</span>
                                    <?php elseif ($order['status'] == 'done') : ?>
                                        <span class="badge badge-success">Selesai</span>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Tgl. Booking</th>
                                <th scope="col">Harga (Rp.)</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total (Rp.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($order_detail != 0) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($order_detail as $o_det) : ?>
                                    <tr class="text-center">
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $o_det['nama_produk']; ?></td>
                                        <td><?= $o_det['tgl_booking']; ?></td>
                                        <td><?= number_format($o_det['harga_jual'], 2, ',', '.'); ?></td>
                                        <td><?= $o_det['jumlah']; ?></td>
                                        <td><?= number_format($o_det['total_harga'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row" colspan="5" class="text-right text-white bg-secondary">Grand Total (Rp.)</th>
                                    <td class="text-center font-weight-bold"><?= number_format($order['total_harga'], 2, ',', '.'); ?></td>
                                </tr>
                            <?php else : ?>
                                <tr class="text-center">
                                    <th scope="row">Data tidak ditemukan</th>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>