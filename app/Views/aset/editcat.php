<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/aset/category" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Kategori Aset</h6>
            </div>
            <div class="card-body">
                <form action="/aset/updatecategory" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="kategori_aset_id" value="<?= $kategori['id']; ?>">
                    <input type="hidden" name="old_nama_kategori_aset" value="<?= $kategori['nama_kategori_aset']; ?>">
                    <div class="form-group row">
                        <label for="nama_kategori_aset" class="col-sm-3 col-form-label">Nama Kategori</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_kategori_aset" id="nama_kategori_aset" value="<?= $kategori['nama_kategori_aset']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_aset" class="col-sm-3 col-form-label">Kode Akun</label>
                        <div class="input-group col-sm-9">
                            <select name="kode_akun_aset" id="kode_akun_aset" class="form-control custom-select">
                                <option>Pilih Kode Akun</option>
                                <?php foreach ($akun as $acct) : ?>
                                    <option value="<?= $acct['id']; ?>" <?= ($kategori['akun_id'] == $acct['id'] ? 'selected' : ''); ?>>(<?= $acct['kode_akun']; ?>) <?= $acct['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persen_penyusutan" class="col-sm-3 col-form-label">Nilai Penyusutan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="persen_penyusutan" id="persen_penyusutan" maxlength="5" value="<?= $kategori['persen_penyusutan']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>