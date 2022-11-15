<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/gaji" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Gaji Staf</h6>
            </div>
            <div class="card-body">
                <form action="/gaji/insert" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_staf" class="col-sm-3 col-form-label">Nama Staf</label>
                        <div class="col-sm-9">
                            <select name="nama_staf" id="nama_staf" class="form-control custom-select" value="<?= old('nama_staf'); ?>">
                                <option>Pilih Staf ...</option>
                                <?php foreach ($staf as $staf) : ?>
                                    <option value="<?= $staf['id']; ?>" <?= ($staf['id'] == old('nama_staf') ? 'selected' : ''); ?>><?= $staf['nama_staf']; ?> (Tgl. Masuk : <?= date_indo($staf['tgl_masuk']); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_gaji" class="col-sm-3 col-form-label">Kode Akun Gaji</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_gaji" id="kode_akun_gaji" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_gaji) : ?>
                                    <option value="<?= $akun_gaji['id']; ?>" <?= ($akun_gaji['id'] == old('kode_akun_gaji') ? 'selected' : ''); ?>><?= $akun_gaji['kode_kategori_akun']; ?>-<?= $akun_gaji['kode_akun']; ?> - <?= $akun_gaji['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah_gaji" class="col-sm-3 col-form-label">Jumlah Gaji</label>
                        <div class="input-group col-sm-9">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="number" class="form-control" name="jumlah_gaji" id="jumlah_gaji" value="<?= old('jumlah_gaji'); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">/ bulan</span>
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

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>