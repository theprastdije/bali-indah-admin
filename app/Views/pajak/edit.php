<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pajak" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Jenis Pajak</h6>
            </div>
            <div class="card-body">
                <form action="/pajak/update" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_pajak" class="col-sm-3 col-form-label">Nama Pajak</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama_pajak" id="nama_pajak" value="<?= $pajak['jenis_pajak']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_akun_pajak" class="col-sm-3 col-form-label">Kode Akun Pajak</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_pajak" id="kode_akun_pajak" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_pajak) : ?>
                                    <option value="<?= $akun_pajak['id']; ?>" <?= ($akun_pajak['id'] == $pajak['akun_pajak_id'] ? 'selected' : ''); ?>><?= $akun_pajak['kode_kategori_akun']; ?>-<?= $akun_pajak['kode_akun']; ?> - <?= $akun_pajak['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori_pajak" class="col-sm-3 col-form-label">Kategori Pajak</label>
                        <div class="col-sm-9">
                            <select name="kategori_pajak" id="kategori_pajak" class="form-control custom-select">
                                <option>Pilih Kategori Pajak ...</option>
                                <option value="penjualan" <?= (old('kategori_pajak') == "penjualan") ? 'selected' : ''; ?>>Penjualan</option>
                                <option value="pembelian" <?= (old('kategori_pajak') == "pembelian") ? 'selected' : ''; ?>>Pembelian</option>
                                <option value="penghasilan" <?= (old('kategori_pajak') == "penghasilan") ? 'selected' : ''; ?>>Penghasilan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi_pajak" class="col-sm-3 col-form-label">Deskripsi Pajak</label>
                        <div class="input-group col-sm-9">
                            <textarea name="deskripsi_pajak" rows="2" class="form-control" id="deskripsi_pajak"><?= $pajak['deskripsi_pajak']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tarif_pajak" class="col-sm-3 col-form-label">Tarif Pajak</label>
                        <div class="input-group col-sm-9">
                            <input type="text" class="form-control" name="tarif_pajak" id="tarif_pajak" value="<?= $pajak['tarif_pajak']; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pajak_id" value="<?= $pajak['id']; ?>">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>