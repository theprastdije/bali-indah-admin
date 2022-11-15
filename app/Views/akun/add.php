<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/akun" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Akun</h6>
            </div>
            <div class="card-body">
                <form action="/akun/insert" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_akun" class="col-sm-3 col-form-label">Nama Akun</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_akun" id="nama_akun" value="<?= old('nama_akun'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori_akun" class="col-sm-3 col-form-label">Kategori Akun</label>
                        <div class="col-sm-9">
                            <select name="kategori_akun" id="kategori_akun" class="form-control custom-select">
                                <option>Pilih Kategori ...</option>
                                <?php foreach ($kategori as $kategori) : ?>
                                    <option value="<?= $kategori['id']; ?>" <?= ($kategori['id'] == old('kategori_akun')) ? 'selected' : ''; ?>>(<?= $kategori['kode_kategori_akun']; ?>) <?= $kategori['kategori_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun" class="col-sm-3 col-form-label">Kode Akun</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="kode_akun" id="kode_akun" value="<?= old('kode_akun'); ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>