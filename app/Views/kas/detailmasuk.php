<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/kas" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Kas Masuk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Deskripsi/Keperluan</th>
                                <td><?= $kas_masuk['deskripsi']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td><?= $kas_masuk['kategori_akun']; ?>-<?= $kas_masuk['kode_akun']; ?> - <?= $kas_masuk['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Pajak</th>
                                <td><?= $kas_masuk['jenis_pajak']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tgl. Transaksi</th>
                                <td><?= $kas_masuk['tgl_kas_masuk']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td>Rp. <?= number_format($kas_masuk['jumlah'], 2, ',', '.'); ?></td>
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