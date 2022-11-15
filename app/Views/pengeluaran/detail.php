<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($pengeluaran); ?> -->
<div class="row">
    <div class="col-lg-6">
        <a href="/pengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Pengeluaran</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Tanggal Transaksi</th>
                                <td><?= $harian['tgl_transaksi']; ?></td>
                            </tr>
                            <tr>
                                <!-- Join tb akun -->
                                <th scope="row">Kode Akun</th>
                                <td>(<?= $harian['kategori_akun']; ?>-<?= $harian['kode_akun']; ?>) <?= $harian['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Keperluan Pengeluaran</th>
                                <td><?= $harian['rincian_pengeluaran']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Satuan</th>
                                <td>Rp. <?= number_format($harian['harga_satuan'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td><?= $harian['jumlah']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <td>Rp. <?= number_format($harian['total_pengeluaran'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan</th>
                                <td><?= $harian['catatan']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Bukti Pengeluaran</th>
                                <?php if ($harian['bukti_transaksi']) : ?>
                                    <td><a href="/file/bukti-pengeluaran/<?= $harian['bukti_transaksi']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i> Lihat File</a></td>
                                <?php else : ?>
                                    <td>File tidak ditemukan</td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>