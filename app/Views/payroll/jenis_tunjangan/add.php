<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/tunjangan/jenis" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Jenis Tunjangan</h6>
            </div>
            <div class="card-body">
                <form action="/tunjangan/insertjenis" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="jenis_tunjangan" class="col-sm-3 col-form-label">Jenis Tunjangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jenis_tunjangan" id="jenis_tunjangan" value="<?= old('jenis_tunjangan'); ?>">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_tunjangan" class="col-sm-3 col-form-label">Kode Akun Tunjangan</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_tunjangan" id="kode_akun_tunjangan" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_tunjangan) : ?>
                                    <option value="<?= $akun_tunjangan['id']; ?>" <?= ($akun_tunjangan['id'] == old('kode_akun_tunjangan') ? 'selected' : ''); ?>><?= $akun_tunjangan['kode_kategori_akun']; ?>-<?= $akun_tunjangan['kode_akun']; ?> - <?= $akun_tunjangan['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_tunjangan" class="col-sm-3 col-form-label">Jumlah Tunjangan</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" name="jumlah_tunjangan" id="jumlah_tunjangan" value="<?= old('jumlah_tunjangan'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="periode_tunjangan" class="col-sm-3 col-form-label">Periode Pembayaran Tunjangan</label>
                        <div class="col-sm-9">
                            <select name="periode_tunjangan" id="periode_tunjangan" class="form-control custom-select">
                                <option>Pilih Periode Pembayaran ...</option>
                                <option value="sekali" <?= (old('kode_akun_tunjangan') == 'sekali' ? 'selected' : ''); ?>>Sekali</option>
                                <option value="harian" <?= (old('kode_akun_tunjangan') == 'harian' ? 'selected' : ''); ?>>Harian</option>
                                <option value="bulanan" <?= (old('kode_akun_tunjangan') == 'bulanan' ? 'selected' : ''); ?>>Bulanan</option>
                                <option value="tahunan" <?= (old('kode_akun_tunjangan') == 'tahunan' ? 'selected' : ''); ?>>Tahunan</option>
                            </select>
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