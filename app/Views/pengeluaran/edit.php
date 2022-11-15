<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-8">
        <a href="/pengeluaran" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="alert alert-primary mt-3 pb-0">
            <span><i class="fas fa-fw fa-info-circle"></i> <strong>Mohon perhatikan hal berikut:</strong></span>
            <ul>
                <li>Silakan upload <strong>bukti pengeluaran</strong> jika ada</li>
                <li>File yang dapat diupload hanya <strong>PDF, JPG/JPEG, dan PNG</strong> dengan ukuran <strong>maks. 10 MB</strong></li>
            </ul>
        </div>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pengeluaran</h6>
            </div>
            <div class="card-body mt-2">
                <form action="/pengeluaran/update" method="post" class="mx-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="pengeluaran_id" value="<?= $pengeluaran['id']; ?>">
                    <?php if ($pengeluaran['status_pengajuan'] == 1) : ?>
                        <input type="hidden" name="file_lama" value="<?= $pengeluaran['bukti_transaksi']; ?>">
                    <?php endif; ?>
                    <div class="form-group row">
                        <label for="kode_akun" class="col-sm-3 col-form-label">Kode Akun</label>
                        <div class="col-sm-9">
                            <select class="form-control custom-select <?= ($validation->hasError('kode_akun')) ? 'is-invalid' : ''; ?>" name="kode_akun" id="kode_akun">
                                <option>Pilih kode akun ...</option>
                                <?php foreach ($akun as $acc) : ?>
                                    <option value="<?= $acc['id']; ?>">(<?= $acc['kode_akun']; ?>) <?= $acc['nama_akun']; ?></option>
                                <?php endforeach; ?>
                                <div class="invalid-feedback"><?= $validation->getError('kode_akun'); ?></div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-sm-3 col-form-label">Kategori Pengeluaran</label>
                        <div class="col-sm-9">
                            <select class="form-control custom-select <?= ($validation->hasError('kategori')) ? 'is-invalid' : ''; ?>" name="kategori" id="kategori">
                                <option>Pilih kategori ...</option>
                                <?php foreach ($category as $cat) : ?>
                                    <option <?= ($pengeluaran['kategori_id'] == $cat['id']) ? 'selected' : ''; ?> value="<?= $cat['id']; ?>"><?= $cat['kode_kategori']; ?> - <?= $cat['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('kategori'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pengeluaran" class="col-sm-3 col-form-label">Jenis Pengeluaran</label>
                        <div class="col-sm-9">
                            <select class="form-control custom-select <?= ($validation->hasError('jenis_pengeluaran')) ? 'is-invalid' : ''; ?>" name="jenis_pengeluaran" id="jenis_pengeluaran">
                                <option>Pilih jenis pengeluaran ...</option>
                                <option value="o">Operasional</option>
                                <option value="i">Investasi</option>
                                <option value="p">Pendanaan</option>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('jenis_pengeluaran'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_transaksi" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control <?= ($validation->hasError('tgl_transaksi')) ? 'is-invalid' : ''; ?>" id="tgl_transaksi" name="tgl_transaksi">
                            <div class="invalid-feedback"><?= $validation->getError('tgl_transaksi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= ($validation->hasError('keperluan')) ? 'is-invalid' : ''; ?>" id="keperluan" name="keperluan" value="<?= $pengeluaran['rincian_pengeluaran']; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('keperluan'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_satuan" class="col-sm-3 col-form-label">Harga Satuan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control <?= ($validation->hasError('harga_satuan')) ? 'is-invalid' : ''; ?>" id="harga_satuan" name="harga_satuan" value="<?= $pengeluaran['harga_satuan']; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('harga_satuan'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : ''; ?>" id="jumlah" name="jumlah" value="<?= $pengeluaran['jumlah']; ?>">
                            <div class="invalid-feedback"><?= $validation->getError('jumlah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control <?= ($validation->hasError('total')) ? 'is-invalid' : ''; ?>" id="total" name="total" value="<?= $pengeluaran['total_harga']; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('total'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $pengeluaran['keterangan']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bukti_pengeluaran" class="col-sm-3 col-form-label">Bukti Pengeluaran</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input <?= ($validation->hasError('bukti_pengeluaran')) ? 'is-invalid' : ''; ?>" id="bukti_pengeluaran" name="bukti_pengeluaran" value="<?= $pengeluaran['bukti_transaksi']; ?>">
                                <div class="invalid-feedback"><?= $validation->getError('bukti_pengeluaran'); ?></div>
                                <label for="bukti_pengeluaran" class="custom-file-label">Pilih file ...</label>
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