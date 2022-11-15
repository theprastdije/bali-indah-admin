<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pajak" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Jenis Pajak</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Jenis Pajak</th>
                                <td><?= $pajak['jenis_pajak']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori Pajak</th>
                                <td><?= ucfirst($pajak['kategori_pajak']); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td><?= $pajak['kategori_akun']; ?>-<?= $pajak['kode_akun']; ?> - <?= $pajak['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <td><?= $pajak['deskripsi_pajak']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Tarif Pajak</th>
                                <td><?= $pajak['tarif_pajak']; ?>%</td>
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