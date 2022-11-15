<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/kas" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Kas Masuk</h6>
            </div>
            <div class="card-body">
                <form action="/kas/update" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="kode_akun_kas" class="col-sm-3 col-form-label">Kode Akun Kas</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_kas" id="kode_akun_kas" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_kas) : ?>
                                    <option value="<?= $akun_kas['id']; ?>" <?= ($akun_kas['id'] == $kas_masuk['akun_id'] ? 'selected' : ''); ?>><?= $akun_kas['kode_kategori_akun']; ?>-<?= $akun_kas['kode_akun']; ?> - <?= $akun_kas['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pajak" class="col-sm-3 col-form-label">Jenis Pajak</label>
                        <div class="col-sm-9">
                            <select name="jenis_pajak" id="jenis_pajak" class="form-control custom-select">
                                <option>Pilih Jenis Pajak ...</option>
                                <?php foreach ($pajak as $pajak) : ?>
                                    <option value="<?= $pajak['id']; ?>" <?= ($pajak['id'] == $kas_masuk['pajak_id'] ? 'selected' : ''); ?>><?= $pajak['jenis_pajak']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_kas" class="col-sm-3 col-form-label">Deskripsi</label>
                        <div class="input-group col-sm-9">
                            <textarea name="deskripsi_kas" rows="2" class="form-control" id="deskripsi_kas"><?= $kas_masuk['deskripsi']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_kas" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" class="form-control" name="jumlah_kas" id="jumlah_kas" value="<?= $kas_masuk['jumlah']; ?>">
                        </div>
                    </div>
                    <input type="hidden" name="kas_masuk_id" value="<?= $kas_masuk['id']; ?>">
                    <input type="hidden" name="pendapatan_id" value="<?= $kas_masuk['pendapatan_id']; ?>">
                    <input type="hidden" name="jenis_kas" value="masuk">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>