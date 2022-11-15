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
    </div>
</div>

<form action="/aset/updatecategory" method="post">
    <?= csrf_field(); ?>
    <input type="hidden" name="kategori_aset_id" value="<?= $kategori['id']; ?>">
    <input type="hidden" name="old_nama_kategori_aset" value="<?= $kategori['nama_kategori_aset']; ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="card my-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kategori Aset</h6>
                </div>
                <div class="card-body">
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
                                <?php foreach ($akun as $acc) : ?>
                                    <option value="<?= $acc['id']; ?>" <?= ($kategori['akun_id'] == $acc['id']) ? 'selected' : ''; ?>>(<?= $acc['kode_akun']; ?>) <?= $acc['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_aset" class="col-sm-3 col-form-label">Jenis Aset</label>
                        <div class="input-group col-sm-9">
                            <select name="jenis_aset" id="jenis_aset" class="form-control custom-select">
                                <option>Pilih Jenis Aset</option>
                                <option value="nb1" <?= ($kategori['jenis_aset'] == 'nb1') ? 'selected' : ''; ?>>Bukan Bangunan - Kelompok 1</option>
                                <option value="nb2" <?= ($kategori['jenis_aset'] == 'nb2') ? 'selected' : ''; ?>>Bukan Bangunan - Kelompok 2</option>
                                <option value="nb3" <?= ($kategori['jenis_aset'] == 'nb3') ? 'selected' : ''; ?>>Bukan Bangunan - Kelompok 3</option>
                                <option value="nb4" <?= ($kategori['jenis_aset'] == 'nb4') ? 'selected' : ''; ?>>Bukan Bangunan - Kelompok 4</option>
                                <option value="bp" <?= ($kategori['jenis_aset'] == 'bp') ? 'selected' : ''; ?>>Bangunan Permanen</option>
                                <option value="btp" <?= ($kategori['jenis_aset'] == 'btp') ? 'selected' : ''; ?>>Bangunan Tidak Permanen</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card my-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penyusutan Fiskal</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="metode_penyusutan_fiskal" class="col-sm-3 col-form-label">Metode Penyusutan</label>
                        <div class="input-group col-sm-9">
                            <select name="metode_penyusutan_fiskal" id="metode_penyusutan_fiskal" class="form-control custom-select">
                                <option>Pilih Metode Penyusutan</option>
                                <option value="gl" <?= ($kategori['metode_penyusutan_fiskal'] == 'gl') ? 'selected' : ''; ?>>Garis Lurus</option>
                                <option value="sm" <?= ($kategori['metode_penyusutan_fiskal'] == 'sm') ? 'selected' : ''; ?>>Saldo Menurun</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="masa_manfaat_fiskal" class="col-sm-3 col-form-label">Masa Manfaat</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="masa_manfaat_fiskal" id="masa_manfaat_fiskal" maxlength="2" value="<?= $kategori['masa_manfaat_fiskal']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">tahun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persen_penyusutan_fiskal" class="col-sm-3 col-form-label">Nilai Penyusutan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="persen_penyusutan_fiskal" id="persen_penyusutan_fiskal" maxlength="5" value="<?= $kategori['persen_penyusutan_fiskal']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card my-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penyusutan Komersial</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="metode_penyusutan_komersial" class="col-sm-3 col-form-label">Metode Penyusutan</label>
                        <div class="input-group col-sm-9">
                            <select name="metode_penyusutan_komersial" id="metode_penyusutan_komersial" class="form-control custom-select">
                                <option>Pilih Metode Penyusutan</option>
                                <option value="gl" <?= ($kategori['metode_penyusutan_komersial'] == 'gl') ? 'selected' : ''; ?>>Garis Lurus</option>
                                <option value="sm" <?= ($kategori['metode_penyusutan_komersial'] == 'sm') ? 'selected' : ''; ?>>Saldo Menurun</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="masa_manfaat_komersial" class="col-sm-3 col-form-label">Masa Manfaat</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="masa_manfaat_komersial" id="masa_manfaat_komersial" maxlength="2" value="<?= $kategori['masa_manfaat_komersial']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">tahun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persen_penyusutan_komersial" class="col-sm-3 col-form-label">Nilai Penyusutan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="text" class="form-control" name="persen_penyusutan_komersial" id="persen_penyusutan_komersial" maxlength="5" value="<?= $kategori['persen_penyusutan_komersial']; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection(); ?>