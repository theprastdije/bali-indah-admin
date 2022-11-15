<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pembayaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Jenis Pembayaran</h6>
            </div>
            <div class="card-body">
                <form action="/pembayaran/update" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_jenis_pembayaran" class="col-sm-3 col-form-label">Nama Jenis Pembayaran</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_jenis_pembayaran" id="nama_jenis_pembayaran" value="<?= $pembayaran['nama_jenis_pembayaran']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_pembayaran" class="col-sm-3 col-form-label">Kode Akun Pembayaran</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_pembayaran" id="kode_akun_pembayaran" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_pembayaran) : ?>
                                    <option value="<?= $akun_pembayaran['id']; ?>" <?= ($akun_pembayaran['id'] == $pembayaran['akun_jenis_pembayaran_id'] ? 'selected' : ''); ?>><?= $akun_pembayaran['kode_kategori_akun']; ?>-<?= $akun_pembayaran['kode_akun']; ?> - <?= $akun_pembayaran['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_jenis_pembayaran" class="col-sm-3 col-form-label">Deskripsi Jenis Pembayaran</label>
                        <div class="input-group col-sm-9">
                            <textarea name="deskripsi_jenis_pembayaran" rows="2" class="form-control" id="deskripsi_jenis_pembayaran"><?= $pembayaran['deskripsi_jenis_pembayaran']; ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_pembayaran_id" value="<?= $pembayaran['id']; ?>">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>