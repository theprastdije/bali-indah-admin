<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($pengeluaran); ?> -->
<div class="row">
    <div class="col-lg-6">
        <a href="/tunjangan/jenis" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Jenis Tunjangan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Jenis Tunjangan</th>
                                <td><?= $jenis_tunjangan['jenis_tunjangan']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun Tunjangan</th>
                                <td>(<?= $jenis_tunjangan['kode_akun']; ?>) <?= $jenis_tunjangan['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <!-- Buat kondisi -->
                                <th scope="row">Jumlah Tunjangan</th>
                                <?php if ($jenis_tunjangan['periode_tunjangan'] == "harian") : ?>
                                    <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?> / hari</td>
                                <?php elseif ($jenis_tunjangan['periode_tunjangan'] == "bulanan") : ?>
                                    <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?> / bulan</td>
                                <?php elseif ($jenis_tunjangan['periode_tunjangan'] == "tahunan") : ?>
                                    <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?> / tahun</td>
                                <?php elseif ($jenis_tunjangan['periode_tunjangan'] == "sekali") : ?>
                                    <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?> (dibayar sekali)</td>
                                <?php else : ?>
                                    <td>Rp. <?= number_format($jenis_tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th scope="row">Status Tunjangan</th>
                                <?php if ($jenis_tunjangan['status_tunjangan'] == "1") : ?>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                <?php else : ?>
                                    <td><span class="badge badge-danger">Tidak Aktif</span></td>
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