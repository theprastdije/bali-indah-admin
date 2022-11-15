<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= dd($order, $order_detail); ?> -->
<a href="/penjualan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-secondary text-white">
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
                                    <span><strong>Tgl. Order: </strong><?= $order['tgl_transaksi']; ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span><strong>Order ID: </strong><?= $order['id']; ?></span>
                                </td>
                                <td>
                                    <span><strong>Status Pembayaran: </strong></span>
                                    <?php if ($order['status_pembayaran'] == 'order') : ?>
                                        <span class="badge badge-danger">Menunggu pelunasan</span>
                                    <?php elseif ($order['status_pembayaran'] == 'lunas') : ?>
                                        <span class="badge badge-success">Lunas</span>
                                    <?php elseif ($order['status_pembayaran'] == 'selesai') : ?>
                                        <span class="badge badge-primary">Selesai</span>
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
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga Jual (Rp.)</th>
                                <th scope="col">Diskon (Rp.)</th>
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
                                        <td><?= $o_det['qty_produk']; ?></td>
                                        <td><?= number_format($o_det['harga_jual_satuan'], 2, ',', '.'); ?></td>
                                        <td><?= number_format((($o_det['harga_jual_satuan'] * $o_det['qty_produk']) - $o_det['total_harga_jual']), 2, ',', '.'); ?></td>
                                        <td><?= number_format($o_det['total_harga_jual'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <th scope="row" colspan="6" class="text-right">Subtotal (Rp.)</th>
                                    <td class="text-center font-weight-bold"><?= number_format($order['subtotal'], 2, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="6" class="text-right">Pajak Penjualan (Rp.)</th>
                                    <td class="text-center font-weight-bold"><?= number_format(($order['total_belanja'] - $order['subtotal']), 2, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="6" class="text-right text-white bg-secondary">Grand Total (Rp.)</th>
                                    <td class="text-center font-weight-bold"><?= number_format($order['total_belanja'], 2, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="6" class="text-right text-white bg-secondary">Jumlah Dibayar (Rp.)</th>
                                    <td class="text-center font-weight-bold"><?= number_format($order['jumlah_pembayaran'], 2, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <?php if ($order['jumlah_pembayaran'] < $order['total_belanja']) : ?>
                                        <th scope="row" colspan="6" class="text-right text-danger">Sisa Pembayaran (Rp.)</th>
                                        <td class="text-center text-danger font-weight-bold"><?= number_format(($order['jumlah_pembayaran'] - $order['total_belanja']), 2, ',', '.'); ?></td>
                                    <?php else : ?>
                                        <th scope="row" colspan="6" class="text-right">Kembali (Rp.)</th>
                                        <td class="text-center font-weight-bold"><?= number_format(($order['jumlah_pembayaran'] - $order['total_belanja']), 2, ',', '.'); ?></td>
                                    <?php endif; ?>
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