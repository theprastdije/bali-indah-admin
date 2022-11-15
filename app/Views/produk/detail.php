<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/produk" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Produk</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Nama Produk</th>
                                <td>
                                    <div class="text font-weight-bold"><?= $produk['nama_produk']; ?></div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Kategori Produk</th>
                                <td><?= $produk['kode_kategori_produk']; ?>-<?= $produk['nama_kategori_produk']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi Produk</th>
                                <td><?= $produk['deskripsi_produk']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Produk</th>
                                <td>Rp. <?= number_format($produk['harga_produk'], 2, ',', '.'); ?></td>
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