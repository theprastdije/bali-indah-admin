<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pembayaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Jenis Pembayaran</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Jenis Pembayaran</th>
                                <td><?= $pembayaran['nama_jenis_pembayaran']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td><?= $pembayaran['kategori_akun']; ?>-<?= $pembayaran['kode_akun']; ?> - <?= $pembayaran['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Jenis Pembayaran</th>
                                <td><?= $pembayaran['deskripsi_jenis_pembayaran']; ?></td>
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