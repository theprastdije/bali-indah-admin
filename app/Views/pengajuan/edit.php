<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= dd($pengajuan); ?> -->
<div class="row">
    <div class="col-lg-8">
        <a href="/pengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="alert alert-primary mt-3 pb-0">
            <span><i class="fas fa-fw fa-info-circle"></i> <strong>Mohon perhatikan hal berikut:</strong></span>
            <ul>
                <li>Silakan upload <strong>bukti pengeluaran</strong> jika ada</li>
                <li>File yang dapat diupload hanya <strong>PDF, JPG/JPEG, dan PNG</strong> dengan ukuran <strong>maks. 10 MB</strong></li>
            </ul>
        </div>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Pengajuan Pengeluaran</h6>
            </div>
            <div class="card-body mt-2">
                <form action="/pengajuan/update" method="post" class="mx-3" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="kode_akun_pengeluaran" class="col-sm-3 col-form-label">Kode Akun Pajak</label>
                        <div class="col-sm-9">
                            <select name="kode_akun_pengeluaran" id="kode_akun_pengeluaran" class="form-control custom-select">
                                <option>Pilih Kode Akun ...</option>
                                <?php foreach ($akun as $akun_pengeluaran) : ?>
                                    <option value="<?= $akun_pengeluaran['id']; ?>" <?= ($akun_pengeluaran['id'] == $pengajuan['akun_id'] ? 'selected' : ''); ?>><?= $akun_pengeluaran['kode_kategori_akun']; ?>-<?= $akun_pengeluaran['kode_akun']; ?> - <?= $akun_pengeluaran['nama_akun']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rincian_pengeluaran" class="col-sm-3 col-form-label">Keperluan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="rincian_pengeluaran" name="rincian_pengeluaran" value="<?= $pengajuan['rincian_pengeluaran']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_transaksi" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_transaksi" name="tgl_transaksi" value="<?= $pengajuan['tgl_transaksi']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_satuan" class="col-sm-3 col-form-label">Harga Satuan</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $pengajuan['harga_satuan']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $pengajuan['jumlah']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total" class="col-sm-3 col-form-label">Total</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="total" name="total" value="<?= $pengajuan['total_pengeluaran']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-sm-3 col-form-label">Metode Pembayaran</label>
                        <div class="col-sm-9">
                            <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control custom-select">
                                <option>Pilih Metode Pembayaran ...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-sm-9">
                            <textarea name="catatan" class="form-control" id="catatan" cols="3"><?= $pengajuan['catatan']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bukti_pengeluaran" class="col-sm-3 col-form-label">Bukti Transaksi</label>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="form-control custom-file-input" id="bukti_pengeluaran" name="bukti_pengeluaran" onchange="file_pengeluaran()" value="<?= $pengajuan['bukti_pengeluaran']; ?>">
                                <label for="bukti_pengeluaran" class="custom-file-label">Pilih file ...</label>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pengajuan_id" value="<?= $pengajuan['id']; ?>">
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    var harga_satuan = 0;
    var jumlah = 0;
    $("#harga_satuan").change(function() {
        harga_satuan = $(this).val();
        $("#total").val(harga_satuan * jumlah);
    });
    $("#jumlah").change(function() {
        jumlah = $(this).val();
        $("#total").val(harga_satuan * jumlah);
    });

    function file_pengeluaran() {
        const bukti_pengeluaran = document.querySelector('#bukti_pengeluaran');
        const label_file = document.querySelector('.custom-file-label');
        label_file.textContent = bukti_pengeluaran.files[0].name;
        const file = new FileReader();
        file.readAsDataURL(bukti_pengeluaran.files[0]);
    }
</script>
<?= $this->endSection(); ?>