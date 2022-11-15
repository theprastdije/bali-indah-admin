<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-8">
        <a href="/pendapatan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Pendapatan</h6>
            </div>
            <div class="card-body mt-2">
                <form action="/pendapatan/insert" method="post" class="mx-3">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="kode_akun" class="col-sm-3 col-form-label">Kode Akun</label>
                        <div class="col-sm-9">
                            <select class="form-control custom-select" name="kode_akun" id="kode_akun">
                                <option>Pilih kode akun ...</option>
                                <?php foreach ($akun as $acc) : ?>
                                    <option value="<?= $acc['id']; ?>">(<?= $acc['kode_akun']; ?>) <?= $acc['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pendapatan" class="col-sm-3 col-form-label">Jenis Pendapatan</label>
                        <div class="col-sm-9">
                            <select class="form-control custom-select" name="jenis_pendapatan" id="jenis_pendapatan">
                                <option>Pilih jenis pendapatan ...</option>
                                <option value="o">Operasional</option>
                                <option value="i">Investasi</option>
                                <option value="p">Pendanaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_transaksi" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rincian" class="col-sm-3 col-form-label">Rincian</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rincian" name="rincian">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>