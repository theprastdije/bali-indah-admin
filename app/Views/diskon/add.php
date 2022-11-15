<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/diskon" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Diskon</h6>
            </div>
            <div class="card-body">
                <form action="/diskon/insert" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_diskon" class="col-sm-3 col-form-label">Nama Diskon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_diskon" id="nama_diskon" value="<?= old('nama_diskon'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_diskon" class="col-sm-3 col-form-label">Kode Akun</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_diskon" id="kode_akun_diskon" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_diskon) : ?>
                                    <option value="<?= $akun_diskon['id']; ?>" <?= ($akun_diskon['id'] == old('kode_akun_diskon') ? 'selected' : ''); ?>><?= $akun_diskon['kode_kategori_akun']; ?>-<?= $akun_diskon['kode_akun']; ?> - <?= $akun_diskon['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_diskon" class="col-sm-3 col-form-label">Kode Diskon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_diskon" id="kode_diskon" value="<?= old('kode_diskon'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_diskon" class="col-sm-3 col-form-label">Deskripsi Diskon</label>
                        <div class="input-group col-sm-9">
                            <textarea name="deskripsi_diskon" rows="2" class="form-control" id="deskripsi_diskon"><?= old('deskripsi_diskon'); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_diskon" class="col-sm-3 col-form-label">Jumlah Diskon</label>
                        <div class="input-group col-sm-9">
                            <input type="number" class="form-control col-9" name="jumlah_diskon" id="jumlah_diskon" value="<?= old('jumlah_diskon'); ?>">
                            <select name="satuan_diskon" id="satuan_diskon" class="form-control custom-select col-3">
                                <option>Satuan ...</option>
                                <option value="persen">Persen (%)</option>
                                <option value="jumlah">Rupiah (Rp.)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_diskon" class="col-sm-3 col-form-label">Periode Diskon</label>
                        <div class="input-group col-sm-9">
                            <input type="datetime-local" class="form-control" name="periode_awal_diskon" id="periode_awal_diskon" value="<?= old('periode_awal_diskon'); ?>">
                            <label class="text px-1 col-form-label">s.d.</label>
                            <input type="datetime-local" class="form-control" name="periode_akhir_diskon" id="periode_akhir_diskon" value="<?= old('periode_akhir_diskon'); ?>">
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