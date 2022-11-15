<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($penjualan, $jenis, $periode); ?> -->
<a href="/penjualan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body">
                <form action="/penjualan/laporan" method="get">
                    <div class="form-group row px-2">
                        <label for="produk_id" class="col-12 col-form-label">Produk</label>
                        <div class="col-12">
                            <select name="produk_id" id="produk_id" class="form-control custom-select">
                                <option value="d">Semua produk</option>
                                <?php foreach ($produk as $list_produk) : ?>
                                    <option value="<?= $list_produk['id']; ?>"><?= $list_produk['nama_produk']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="periode" class="col-12 col-form-label">Periode Laporan</label>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Dari tgl.">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">s.d.</span>
                                </div>
                                <input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Sampai tgl.">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-fw fa-list"></i> Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <table class="table table-bordered">
                                <?php if ($jenis == 'default') : ?>
                                    <!-- Default -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Penjualan<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= month_indo(date('Y-m-j')); ?></th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Nama Produk</th>
                                            <th scope="col" class="col-3 text-center">Jumlah Terjual</th>
                                            <th scope="col" class="col-3 text-center">Total Penjualan</th>
                                        </tr>
                                        <?php if ($penjualan) : ?>
                                            <?php foreach ($penjualan as $penjualan_perbulan) : ?>
                                                <tr>
                                                    <td><?= $penjualan_perbulan['nama_produk']; ?></td>
                                                    <td><?= $penjualan_perbulan['jml_produk']; ?></td>
                                                    <td>Rp. <?= number_format($penjualan_perbulan['total_penjualan'], '2', ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <td colspan="3" class="text-center">Belum ada penjualan</td>
                                        <?php endif; ?>
                                    </tbody>
                                <?php elseif ($jenis == 'periode') : ?>
                                    <!-- Periode -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Penjualan<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Produk : Semua Produk | Periode : <?= $periode; ?></th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Nama Produk</th>
                                            <th scope="col" class="col-3 text-center">Jumlah Terjual</th>
                                            <th scope="col" class="col-3 text-center">Total Penjualan</th>
                                        </tr>
                                        <?php if ($penjualan) : ?>
                                            <?php foreach ($penjualan as $penjualan_periode) : ?>
                                                <tr>
                                                    <td><?= $penjualan_periode['nama_produk']; ?></td>
                                                    <td><?= $penjualan_periode['jml_produk']; ?></td>
                                                    <td>Rp. <?= number_format($penjualan_periode['total_penjualan'], '2', ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <td colspan="3" class="text-center">Belum ada penjualan</td>
                                        <?php endif; ?>
                                    </tbody>
                                <?php elseif ($jenis == 'produk') : ?>
                                    <!-- Produk -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Penjualan<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($penjualan) : ?>
                                            <tr>
                                                <th colspan="3">Produk : <?= $penjualan[0]['nama_produk']; ?> | Periode : <?= $periode; ?></th>
                                            </tr>
                                        <?php else : ?>
                                            <tr>
                                                <th colspan="3">Produk : <?= $produk_dipilih['nama_produk']; ?> | Periode : <?= $periode; ?></th>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Tgl. Penjualan</th>
                                            <th scope="col" class="col-3 text-center">Jumlah Terjual</th>
                                            <th scope="col" class="col-3 text-center">Total Penjualan</th>
                                        </tr>
                                        <?php if ($penjualan) : ?>
                                            <?php foreach ($penjualan as $penjualan_produk) : ?>
                                                <tr>
                                                    <td><?= date_indo($penjualan_produk['tgl_booking']); ?></td>
                                                    <td><?= $penjualan_produk['jml_produk']; ?></td>
                                                    <td>Rp. <?= number_format($penjualan_produk['total_penjualan'], '2', ',', '.'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <td colspan="3" class="text-center">Belum ada penjualan</td>
                                        <?php endif; ?>
                                    </tbody>
                                <?php else : ?>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>