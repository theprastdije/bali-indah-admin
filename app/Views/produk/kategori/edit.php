<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/produk/category" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Kategori Produk</h6>
            </div>
            <div class="card-body">
                <form action="/produk/updatecategory" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_kategori_produk" class="col-sm-3 col-form-label">Nama Kategori Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_kategori_produk" id="nama_kategori_produk" value="<?= $kategori['nama_kategori_produk']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_kategori_produk" class="col-sm-3 col-form-label">Kode Kategori Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_kategori_produk" id="kode_kategori_produk" value="<?= $kategori['kode_kategori_produk']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_produk" class="col-sm-3 col-form-label">Kode Akun Produk</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_produk" id="kode_akun_produk" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_produk) : ?>
                                    <option value="<?= $akun_produk['id']; ?>" <?= ($akun_produk['id'] == $kategori['akun_produk_id']) ? 'selected' : ''; ?>><?= $akun_produk['kode_kategori_akun']; ?>-<?= $akun_produk['kode_akun']; ?> - <?= $akun_produk['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="kategori_produk_id" value="<?= $kategori['id']; ?>">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>