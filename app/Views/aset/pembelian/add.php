<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/aset" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pembelian Aset</h6>
            </div>
            <div class="card-body">
                <form action="/pembelianaset/insert" method="post">
                    <?= csrf_field(); ?>
                    <!-- Detail aset -->
                    <div class="text h5 font-weight-bold">Detail Aset</div>
                    <div class="row">
                        <!-- Row kiri -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="nama_aset" class="col-sm-3 col-form-label">Nama Aset</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama_aset" id="nama_aset" value="<?= old('nama_aset'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_aset" class="col-sm-3 col-form-label">Kode Aset</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kode_aset" id="kode_aset" value="<?= old('kode_aset'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_akun_aset" class="col-sm-3 col-form-label">Kode Akun Aset</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_aset" id="kode_akun_aset" class="form-control custom-select">
                                        <option>Pilih Kode Akun Aset ...</option>
                                        <?php foreach ($akun as $akun_aset) : ?>
                                            <option value="<?= $akun_aset['id']; ?>" <?= ($akun_aset['id'] == old('kode_akun_aset') ? 'selected' : ''); ?>><?= $akun_aset['kode_kategori_akun']; ?>-<?= $akun_aset['kode_akun']; ?> - <?= $akun_aset['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi_aset" class="col-sm-3 col-form-label">Deskripsi Aset</label>
                                <div class="input-group col-sm-9">
                                    <textarea name="deskripsi_aset" rows="2" class="form-control" id="deskripsi_aset"><?= old('deskripsi_aset'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Row kanan -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="harga_perolehan" class="col-sm-3 col-form-label">Harga Beli</label>
                                <div class="input-group col-sm-9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control" name="harga_perolehan" id="harga_perolehan" value="<?= old('harga_perolehan'); ?>">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+</span>
                                    </div>
                                    <input type="number" class="form-control" name="tarif_pajak" id="tarif_pajak" value="<?= old('tarif_pajak'); ?>" placeholder="Pajak" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_perolehan" class="col-sm-3 col-form-label">Tgl. Pembelian</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" name="tgl_perolehan" id="tgl_perolehan" value="<?= old('tgl_perolehan'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pajak_pembelian" class="col-sm-3 col-form-label">Pajak Pembelian</label>
                                <div class="col-sm-9">
                                    <select name="pajak_pembelian" id="pajak_pembelian" class="form-control custom-select">
                                        <option value="">Pilih Pajak Pembelian ...</option>
                                        <?php foreach ($pajak as $pajak_pembelian) : ?>
                                            <option value="<?= $pajak_pembelian['id']; ?>" <?= ($pajak_pembelian['id'] == old('pajak_pembelian')) ? 'selected' : ''; ?>><?= $pajak_pembelian['jenis_pajak']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="metode_pembayaran" class="col-sm-3 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-9">
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control custom-select">
                                        <option>Pilih Metode Pembayaran ...</option>
                                        <?php foreach ($jenis_pembayaran as $bayar) : ?>
                                            <option value="<?= $bayar['id']; ?>" <?= ($bayar['id'] == old('metode_pembayaran')) ? 'selected' : ''; ?>><?= $bayar['nama_jenis_pembayaran']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_akun_pembelian_aset" class="col-sm-3 col-form-label">Kode Akun Pembelian</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_pembelian_aset" id="kode_akun_pembelian_aset" class="form-control custom-select">
                                        <option>Pilih Kode Akun Pembelian ...</option>
                                        <?php foreach ($akun as $akun_pembelian) : ?>
                                            <option value="<?= $akun_pembelian['id']; ?>" <?= ($akun_pembelian['id'] == old('kode_akun_pembelian_aset') ? 'selected' : ''); ?>><?= $akun_pembelian['kode_kategori_akun']; ?>-<?= $akun_pembelian['kode_akun']; ?> - <?= $akun_pembelian['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="depresiasi_aset" class="col-sm-3 col-form-label">Dapat disusutkan?</label>
                                <div class="col-sm-9 ">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="depresiasi_aset" id="depresiasi_aset_y" value="y" <?= (old('depresiasi_aset') == 'y') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="depresiasi_aset_y">Ya</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="depresiasi_aset" id="depresiasi_aset_n" value="n" <?= (old('depresiasi_aset') == 'n') ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="depresiasi_aset_n">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3 mt-0">
                    <div class="text h5 font-weight-bold">Penyusutan Aset</div>
                    <!-- Detail penyusutan aset -->
                    <div class="row" id="penyusutan">
                        <!-- Row kiri -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="metode_penyusutan" class="col-sm-3 col-form-label">Metode Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="metode_penyusutan" id="metode_penyusutan" class="form-control custom-select">
                                        <option>Pilih Metode Penyusutan ...</option>
                                        <option value="gl" <?= (old('metode_penyusutan') == 'gl') ? 'selected' : ''; ?>>Garis Lurus</option>
                                        <option value="sm" <?= (old('metode_penyusutan') == 'sm') ? 'selected' : ''; ?>>Saldo Menurun</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="masa_manfaat" class="col-sm-3 col-form-label">Masa Manfaat</label>
                                <div class="input-group col-sm-9">
                                    <input type="number" class="form-control" name="masa_manfaat" id="masa_manfaat" value="<?= old('masa_manfaat'); ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">tahun</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai_penyusutan" class="col-sm-3 col-form-label">Nilai Penyusutan</label>
                                <div class="input-group col-sm-9">
                                    <input type="text" class="form-control" name="nilai_penyusutan" id="nilai_penyusutan" value="<?= old('nilai_penyusutan'); ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">% per tahun</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nilai_akumulasi_penyusutan" class="col-sm-3 col-form-label">Nilai Akum. Penyusutan</label>
                                <div class="input-group col-sm-9">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input type="number" class="form-control" name="nilai_akumulasi_penyusutan" id="nilai_akumulasi_penyusutan" value="<?= old('nilai_akumulasi_penyusutan'); ?>">
                                </div>
                            </div>
                        </div>
                        <!-- Row kanan -->
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="kode_akun_penyusutan" class="col-sm-3 col-form-label">Kode Akun Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_penyusutan" id="kode_akun_penyusutan" class="form-control custom-select">
                                        <option>Pilih Kode Akun ...</option>
                                        <?php foreach ($akun as $akun_penyusutan) : ?>
                                            <option value="<?= $akun_penyusutan['id']; ?>" <?= ($akun_penyusutan['id'] == old('kode_akun_penyusutan') ? 'selected' : ''); ?>><?= $akun_penyusutan['kode_kategori_akun']; ?>-<?= $akun_penyusutan['kode_akun']; ?> - <?= $akun_penyusutan['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_akun_akumulasi_penyusutan" class="col-sm-3 col-form-label">Akun Akumulasi Penyusutan</label>
                                <div class="col-sm-9">
                                    <select name="kode_akun_akumulasi_penyusutan" id="kode_akun_akumulasi_penyusutan" class="form-control custom-select">
                                        <option>Pilih Kode Akun ...</option>
                                        <?php foreach ($akun as $akun_akumulasi_penyusutan) : ?>
                                            <option value="<?= $akun_akumulasi_penyusutan['id']; ?>" <?= ($akun_akumulasi_penyusutan['id'] == old('kode_akun_akumulasi_penyusutan') ? 'selected' : ''); ?>><?= $akun_akumulasi_penyusutan['kode_kategori_akun']; ?>-<?= $akun_akumulasi_penyusutan['kode_akun']; ?> - <?= $akun_akumulasi_penyusutan['nama_akun']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="th_akumulasi_penyusutan" class="col-sm-3 col-form-label">Thn. Akum. Penyusutan</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="th_akumulasi_penyusutan" id="th_akumulasi_penyusutan" value="<?= old('th_akumulasi_penyusutan'); ?>">
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

<?= $this->section('script'); ?>
<script type="text/javascript">
    $('#pajak_pembelian').change(function() {
        var id = $(this).val();
        var harga_beli = $('#harga_perolehan').val();
        // console.log($(this).val());
        $.ajax({
            type: "GET",
            dataType: "json",
            data: {
                name: "name"
            },
            url: "<?= base_url(); ?>/datapajak",
            success: function(res) {
                $.each(res, function(index, value) {
                    if (value.id == id) {
                        // console.log((parseFloat(value.tarif_pajak) * harga_beli / 100) + parseFloat(harga_beli));
                        var hasil_pajak = (parseFloat(value.tarif_pajak) * harga_beli / 100);
                        $('#tarif_pajak').val(hasil_pajak);
                    }
                    // console.log(value.id == id);
                });
            }
        });
    });

    $('#depresiasi_aset_n').click(function() {
        // 
        $('#penyusutan :input').prop("disabled", true);
    })
    $('#depresiasi_aset_y').click(function() {
        // 
        $('#penyusutan :input').prop("disabled", false);
    })
</script>
<?= $this->endSection(); ?>