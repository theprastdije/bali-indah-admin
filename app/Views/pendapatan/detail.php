<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pendapatan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Pendapatan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Tanggal Input</th>
                                <td><?= $pendapatan['created_at']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Update Terakhir</th>
                                <td><?= $pendapatan['updated_at']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td>(<?= $pendapatan['kode_akun']; ?>) <?= $pendapatan['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Pendapatan</th>
                                <td>
                                    <?php if ($pendapatan['kategori_pendapatan'] == "o") : ?>
                                        Operasional
                                    <?php elseif ($pendapatan['kategori_pendapatan'] == "i") : ?>
                                        Investasi
                                    <?php elseif ($pendapatan['kategori_pendapatan'] == "p") : ?>
                                        Pendanaan
                                    <?php else : ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Transaksi</th>
                                <td><?= $pendapatan['tgl_transaksi']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Rincian</th>
                                <td><?= $pendapatan['rincian_pendapatan']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td>Rp. <?= number_format($pendapatan['jumlah'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Keterangan</th>
                                <td>
                                    <?php if ($pendapatan['keterangan']) : ?>
                                        <?= $pendapatan['keterangan']; ?>
                                    <?php else : ?>
                                        -
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
<?= $this->endSection(); ?>