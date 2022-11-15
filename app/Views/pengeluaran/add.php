<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <a href="/pengeluaran" class="btn btn-info mb-3"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pengeluaran</h6>
            </div>
            <div class="card-body">
                <form action="/pengeluaran/save" method="post">
                    <div class="form-group fieldGroup">
                        <div class="input-group">
                            <input type="date" class="form-control mr-2" name="tanggal[]" id="tanggal" placeholder="Tanggal">
                            <select class="form-control custom-select mx-2" name="kategori[]" id="kategori">
                                <option selected>Kategori...</option>
                                <?php foreach ($category as $kat) : ?>
                                    <option value="<?= $kat['id']; ?>"><?= $kat['kode_kategori']; ?> - <?= $kat['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" class="form-control mx-2" name="rincian[]" id="rincian" placeholder="Rincian">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="satuan">Rp.</label>
                            </div>
                            <input type="text" class="form-control mr-2" name="satuan[]" id="satuan" placeholder="Harga Satuan">
                            <input type="text" class="form-control mx-2" name="jumlah[]" id="jumlah" placeholder="Jumlah">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="total">Rp.</label>
                            </div>
                            <input type="text" class="form-control mr-2" name="total[]" id="total" placeholder="Total">
                            <input type="text" class="form-control mx-2" name="keterangan[]" id="keterangan" placeholder="Keterangan">
                            <div class="input-group-addon ml-1">
                                <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fas fa-fw fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
        <div class="form-group fieldGroupCopy invisible">
            <div class="input-group">
                <input type="date" class="form-control mr-2" name="tanggal[]" id="tanggal" placeholder="Tanggal">
                <select class="form-control custom-select mx-2" name="kategori[]" id="kategori">
                    <option selected>Kategori...</option>
                    <?php foreach ($category as $kat) : ?>
                        <option value="<?= $kat['id']; ?>"><?= $kat['kode_kategori']; ?> - <?= $kat['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" class="form-control mx-2" name="rincian[]" id="rincian" placeholder="Rincian">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="jumlah">Rp.</label>
                </div>
                <input type="text" class="form-control mr-2" name="satuan[]" id="satuan" placeholder="Harga Satuan">
                <input type="text" class="form-control mx-2" name="jumlah[]" id="jumlah" placeholder="Jumlah">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="total">Rp.</label>
                </div>
                <input type="text" class="form-control mr-2" name="total[]" id="total" placeholder="Total">
                <input type="text" class="form-control mx-2" name="keterangan[]" id="keterangan" placeholder="Keterangan">
                <div class="input-group-addon ml-1">
                    <a href="javascript:void(0)" class="btn btn-danger remove"><i class="fas fa-fw fa-minus"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>