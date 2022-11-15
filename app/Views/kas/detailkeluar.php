<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/kas" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Kas Keluar</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Deskripsi/Keperluan</th>
                                <td><?= $kas_keluar['deskripsi']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td><?= $kas_keluar['kategori_akun']; ?>-<?= $kas_keluar['kode_akun']; ?> - <?= $kas_keluar['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Pajak</th>
                                <td><?= $kas_keluar['jenis_pajak']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tgl. Transaksi</th>
                                <td><?= $kas_keluar['tgl_kas_keluar']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td>Rp. <?= number_format($kas_keluar['jumlah'], 2, ',', '.'); ?></td>
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