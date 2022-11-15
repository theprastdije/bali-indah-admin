<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/produk" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
            </div>
            <div class="card-body">
                <form action="/produk/insert" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_produk" class="col-sm-3 col-form-label">Nama Produk</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?= old('nama_produk'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori_produk" class="col-sm-3 col-form-label">Kategori Produk</label>
                        <div class="col-sm-9">
                            <select name="kategori_produk" id="kategori_produk" class="form-control custom-select">
                                <option>Pilih Kategori ...</option>
                                <?php foreach ($kategori as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>"><?= $kategori['kode_kategori_produk']; ?> - <?= $kategori['nama_kategori_produk']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_produk" class="col-sm-3 col-form-label">Deskripsi Produk</label>
                        <div class="input-group col-sm-9">
                            <textarea name="deskripsi_produk" rows="2" class="form-control" id="deskripsi_produk" value="<?= old('deskripsi_produk'); ?>"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_produk" class="col-sm-3 col-form-label">Harga Produk</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" name="harga_produk" id="harga_produk" value="<?= old('harga_produk'); ?>">
                        </div>
                    </div>
                    <input type="hidden" name="tgl_buat" value="<?= $tgl; ?>">
                    <input type="hidden" name="tgl_ubah" value="<?= $tgl; ?>">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>