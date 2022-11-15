<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<a href="/laporan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<!-- <= dd(number_format(floatval($penjualan['SUM(total_harga)']), 2, ',', '.')); ?> -->
<!-- <input type="hidden" name="" value="<= $total_penjualan = number_format(floatval($penjualan['SUM(total_harga)']), 2, ',', '.'); ?>"> -->
<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body pb-0">
                <div class="form-group row px-2">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-6">
                        <input type="number" name="tahun" id="tahun" class="form-control" maxlength="4" required>
                    </div>
                    <button class="btn btn-sm btn-primary col-sm-3"><i class="fas fa-fw fa-clipboard"></i> Generate</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Preview Laporan</h6>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <p>Data Per 7 November 2021</p>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                            PT. Bali Segara Indah<br>
                                            Laporan Laba Rugi<br>
                                            Untuk Tahun yang Berakhir 31 Desember 2021<br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Pendapatan -->
                                    <tr>
                                        <td class="text-left font-weight-bold col-6">Pendapatan</td>
                                        <td class="text-left font-weight-bold col-3"></td>
                                        <td class="text-left font-weight-bold col-3">Rp. <?= $penjualan; ?></td>
                                    </tr>
                                    <!-- Pengeluaran -->
                                    <tr>
                                        <td class="text-left col-6">
                                            <p class="font-weight-bold">Pengeluaran</p>
                                            <?php foreach ($pengeluaran as $p_cat) : ?>
                                                <p><?= $p_cat['nama_kategori']; ?></p>
                                            <?php endforeach; ?>
                                            <p class="font-weight-bold">Total Pengeluaran</p>
                                        </td>
                                        <td class="text-left col-3">
                                            <p>-</p>
                                            <?php foreach ($pengeluaran as $p_tot) : ?>
                                                <p>Rp. <?= number_format(floatval($p_tot['total']), 2, ',', '.'); ?></p>
                                            <?php endforeach; ?>
                                            <p class="font-weight-bold">Rp. <?= number_format(floatval($total_pengeluaran), 2, ',', '.'); ?></p>
                                        </td>
                                        <td class="text-left font-weight-bold col-3"></td>
                                    </tr>
                                    <!-- Total Laba/Rugi Bersih -->
                                    <tr>
                                        <td class="text-left font-weight-bold col-6">Jumlah</td>
                                        <td class="text-left font-weight-bold col-3"></td>
                                        <td class="text-left font-weight-bold col-3">Rp. X</td>
                                    </tr>
                                    <!-- Jumlah Laba/Rugi -->
                                    <tr>
                                        <td class="text-left font-weight-bold col-6">Laba/Rugi Neto</td>
                                        <td class="text-left font-weight-bold col-3"></td>
                                        <td class="text-left font-weight-bold col-3">Rp. X</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>