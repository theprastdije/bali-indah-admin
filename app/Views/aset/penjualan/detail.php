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
                <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan Aset</h6>
            </div>
            <div class="card-body">
                <!-- Detail aset -->
                <div class="text h5 font-weight-bold">Detail Aset</div>
                <div class="row">
                    <!-- Row kiri -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="nama_aset" class="col-sm-3 col-form-label">Nama Aset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nama_aset" id="nama_aset" value="<?= $aset['nama_aset']; ?>" readonly>
                            </div>
                        </div>
                        <!-- Isi otomatis -->
                        <div class="form-group row">
                            <label for="kode_aset" class="col-sm-3 col-form-label">Kode Aset</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="kode_aset" id="kode_aset" value="<?= $aset['kode_aset']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Row kanan -->
                    <!-- Isi otomatis -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="harga_perolehan" class="col-sm-3 col-form-label">Harga Beli</label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" name="harga_perolehan" id="harga_perolehan" value="<?= $aset['harga_perolehan']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_perolehan" class="col-sm-3 col-form-label">Tgl. Pembelian</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_perolehan" id="tgl_perolehan" value="<?= $aset['tgl_perolehan']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-3 mt-0">
                <div class="text h5 font-weight-bold">Penjualan Aset</div>
                <!-- Detail penjualan aset -->
                <div class="row" id="penjualan">
                    <!-- Row kiri -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                            <div class="input-group col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" name="harga_jual" id="harga_jual" value="<?= ($aset_jual['harga_jual'] + $aset_jual['tarif_pajak']); ?>" readonly>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+</span>
                                </div>
                                <input type="number" class="form-control" name="pajak_jual" id="pajak_jual" value="<?= $aset_jual['tarif_pajak']; ?>" placeholder="Pajak" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pajak_penjualan" class="col-sm-3 col-form-label">Pajak Penjualan</label>
                            <div class="col-sm-9">
                                <select name="pajak_penjualan" id="pajak_penjualan" class="form-control custom-select" disabled>
                                    <option value="">Pilih Pajak Penjualan ...</option>
                                    <?php foreach ($pajak as $pajak_penjualan) : ?>
                                        <option value="<?= $pajak_penjualan['id']; ?>" <?= ($pajak_penjualan['id'] == $aset_jual['pajak_id']) ? 'selected' : ''; ?>><?= $pajak_penjualan['jenis_pajak']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="catatan" id="catatan" readonly><?= $aset_jual['catatan']; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Row kanan -->
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label for="tgl_penjualan" class="col-sm-3 col-form-label">Tgl. Penjualan</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_penjualan" id="tgl_penjualan" value="<?= $aset_jual['tgl_penjualan']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_akun_penjualan" class="col-sm-3 col-form-label">Kode Akun Penjualan</label>
                            <div class="col-sm-9">
                                <select name="kode_akun_penjualan" id="kode_akun_penjualan" class="form-control custom-select" disabled>
                                    <option>Pilih Kode Akun ...</option>
                                    <?php foreach ($akun as $akun_penjualan) : ?>
                                        <option value="<?= $akun_penjualan['id']; ?>" <?= ($akun_penjualan['id'] == $aset_jual['akun_id']) ? 'selected' : ''; ?>><?= $akun_penjualan['kode_kategori_akun']; ?>-<?= $akun_penjualan['kode_akun']; ?> - <?= $akun_penjualan['nama_akun']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $('#pajak_penjualan').change(function() {
        var id = $(this).val();
        var harga_jual = $('#harga_jual').val();
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
                        // console.log((parseFloat(value.tarif_pajak) * harga_jual / 100) + parseFloat(harga_jual));
                        var hasil_pajak = (parseFloat(value.tarif_pajak) * harga_jual / 100);
                        $('#pajak_jual').val(hasil_pajak);
                    }
                    // console.log(value.id == id);
                });
            }
        });
    });
</script>
<?= $this->endSection(); ?>