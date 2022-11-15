<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/aset" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Aset</h6>
            </div>
            <div class="card-body">
                <!-- <form action="/aset/update" method="post"> -->
                <!-- <= csrf_field(); ?> -->
                <!-- Detail aset -->
                <div class="text h5 font-weight-bold">Detail Aset</div>
                <div class="row">
                    <!-- Row kiri -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nama_aset" class="col-sm-3 col-form-label">Nama Aset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" name="nama_aset" id="nama_aset" value="<?= $aset['nama_aset']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_aset" class="col-sm-3 col-form-label">Kode Aset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control-plaintext" name="kode_aset" id="kode_aset" value="<?= $aset['kode_aset']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_akun_aset" class="col-sm-3 col-form-label">Kode Akun Aset</label>
                            <div class="col-sm-9">
                                <select name="kode_akun_aset" id="kode_akun_aset" class="form-control-plaintext custom-select" disabled>
                                    <option>Tidak dipilih</option>
                                    <?php foreach ($akun as $akun_aset) : ?>
                                        <option value="<?= $akun_aset['id']; ?>" <?= ($akun_aset['id'] == $aset['akun_aset_id'] ? 'selected' : ''); ?>><?= $akun_aset['kode_kategori_akun']; ?>-<?= $akun_aset['kode_akun']; ?> - <?= $akun_aset['nama_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi_aset" class="col-sm-3 col-form-label">Deskripsi Aset</label>
                            <div class="input-group col-sm-9">
                                <textarea name="deskripsi_aset" rows="2" class="form-control-plaintext" id="deskripsi_aset" readonly><?= $aset['deskripsi_aset']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Row kanan -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="harga_perolehan" class="col-sm-3 col-form-label">Harga Perolehan</label>
                            <div class="input-group col-sm-9">
                                <input type="text" class="form-control-plaintext" name="harga_perolehan" id="harga_perolehan" value="Rp. <?= number_format($aset['harga_perolehan'], 2, ',', '.'); ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_perolehan" class="col-sm-3 col-form-label">Tgl. Perolehan</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control-plaintext" name="tgl_perolehan" id="tgl_perolehan" value="<?= $aset['tgl_perolehan']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="depresiasi_aset" class="col-sm-3 col-form-label">Dapat disusutkan?</label>
                            <div class="col-sm-9 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="depresiasi_aset" id="depresiasi_aset_y" value="y" <?= ($aset['dapat_disusutkan'] == 'y') ? 'checked disabled' : 'disabled'; ?>>
                                    <label class="form-check-label" for="depresiasi_aset_y">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="depresiasi_aset" id="depresiasi_aset_n" value="n" <?= ($aset['dapat_disusutkan'] == 'n') ? 'checked disabled' : 'disabled'; ?>>
                                    <label class="form-check-label" for="depresiasi_aset_n">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($aset['dapat_disusutkan'] == 'y') : ?>
                    <hr class="mb-3 mt-0">
                    <div class="text h5 font-weight-bold">Penyusutan Aset</div>
                    <!-- Detail penyusutan aset -->
                    <div class="row">
                        <!-- Row kiri -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="metode_penyusutan" class="col-sm-3 col-form-label">Metode Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="metode_penyusutan" id="metode_penyusutan" class="form-control-plaintext custom-select" disabled>
                                        <option>Tidak dipilih</option>
                                        <option value="gl" <?= ($penyusutan_aset['metode_penyusutan'] == 'gl') ? 'selected' : 'disabled'; ?>>Garis Lurus</option>
                                        <option value="sm" <?= ($penyusutan_aset['metode_penyusutan'] == 'sm') ? 'selected' : 'disabled'; ?>>Saldo Menurun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="masa_manfaat" class="col-sm-3 col-form-label">Masa Manfaat</label>
                                <div class="input-group col-sm-9">
                                    <input type="text" class="form-control-plaintext" name="masa_manfaat" id="masa_manfaat" value="<?= $penyusutan_aset['masa_manfaat']; ?> tahun" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai_penyusutan" class="col-sm-3 col-form-label">Nilai Penyusutan</label>
                                <div class="input-group col-sm-9">
                                    <input type="text" class="form-control-plaintext" name="nilai_penyusutan" id="nilai_penyusutan" value="<?= $penyusutan_aset['nilai_penyusutan']; ?>% per tahun" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai_akumulasi_penyusutan" class="col-sm-3 col-form-label">Nilai Akum. Penyusutan</label>
                                <div class="input-group col-sm-9">
                                    <input type="text" class="form-control-plaintext" name="nilai_akumulasi_penyusutan" id="nilai_akumulasi_penyusutan" value="Rp. <?= number_format($akum_penyusutan['nilai_akumulasi_penyusutan'], 2, ',', '.'); ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- Row kanan -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="kode_akun_penyusutan" class="col-sm-3 col-form-label">Kode Akun Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_penyusutan" id="kode_akun_penyusutan" class="form-control-plaintext custom-select" disabled>
                                        <option>Tidak dipilih</option>
                                        <?php foreach ($akun as $akun_penyusutan) : ?>
                                            <option value="<?= $akun_penyusutan['id']; ?>" <?= ($akun_penyusutan['id'] == $penyusutan_aset['akun_penyusutan_id'] ? 'selected' : ''); ?>><?= $akun_penyusutan['kode_kategori_akun']; ?>-<?= $akun_penyusutan['kode_akun']; ?> - <?= $akun_penyusutan['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_akun_akumulasi_penyusutan" class="col-sm-3 col-form-label">Akun Akumulasi Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_akumulasi_penyusutan" id="kode_akun_akumulasi_penyusutan" class="form-control-plaintext custom-select" disabled>
                                        <option>Tidak dipilih</option>
                                        <?php foreach ($akun as $akun_akumulasi_penyusutan) : ?>
                                            <option value="<?= $akun_akumulasi_penyusutan['id']; ?>" <?= ($akun_akumulasi_penyusutan['id'] == $akum_penyusutan['akun_akumulasi_penyusutan_id'] ? 'selected' : ''); ?>><?= $akun_akumulasi_penyusutan['kode_kategori_akun']; ?>-<?= $akun_akumulasi_penyusutan['kode_akun']; ?> - <?= $akun_akumulasi_penyusutan['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="th_akumulasi_penyusutan" class="col-sm-3 col-form-label">Thn. Akum. Penyusutan</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" name="th_akumulasi_penyusutan" id="th_akumulasi_penyusutan" value="<?= $akum_penyusutan['tahun_akumulasi_penyusutan']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>