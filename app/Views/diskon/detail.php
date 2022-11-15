<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/diskon" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Diskon</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Diskon</th>
                                <td>
                                    <div class="text font-weight-bold"><?= $diskon['nama_diskon']; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td><?= $diskon['kategori_akun_id']; ?>-<?= $diskon['kode_akun']; ?> - <?= $diskon['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Diskon</th>
                                <td><?= $diskon['deskripsi_diskon']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Diskon</th>
                                <td>
                                    <div class="text font-weight-bold"><?= $diskon['kode_diskon']; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Diskon</th>
                                <td>
                                    <div class="text font-weight-bold">
                                        <?php if ($diskon['satuan_diskon'] == "jumlah") : ?>
                                            Rp. <?= number_format($diskon['jumlah_diskon'], 2, ',', '.'); ?>
                                        <?php elseif ($diskon['satuan_diskon'] == "persen") : ?>
                                            <?= number_format($diskon['jumlah_diskon'], 0, ',', '.'); ?>%
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Tanggal Diskon</th>
                                <td>
                                    <div class="text font-weight-bold"><?= $diskon['periode_awal_diskon']; ?> - <?= $diskon['periode_akhir_diskon']; ?></div>
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

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>