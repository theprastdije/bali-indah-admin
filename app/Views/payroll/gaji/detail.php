<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($list); ?> -->
<!-- <= d(date('m'), date('Y')); ?> -->
<div class="row">
    <div class="col-12 mb-3">
        <a href="/gaji" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahStafModal"><i class="fas fa-fw fa-plus"></i> Tambah Penerima</button> -->
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Staf</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row" class="col-3">Nama Staf</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8"><?= $gaji['nama_staf']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Jumlah Gaji</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8">Rp. <?= number_format($gaji['jumlah_gaji'], 2, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Status Pembayaran</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8">
                                        <?php if ($check['total'] == 1) : ?>
                                            <span class="badge badge-success">Sudah dibayar</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Belum dibayar</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('gaji')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('gaji'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error_gaji')) : ?>
            <div class="alert alert-danger"><i class="fas fa-fw fa-times-circle"></i> <b>ERROR:</b> <?= session()->getFlashdata('error_gaji'); ?></div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Histori Pembayaran Gaji</h6>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#bayarGajiModal"><i class="fas fa-fw fa-plus"></i> Bayar Gaji</button>
                <div class="table-responsive p-1">
                    <table class="table table-hover" id="tabelDetailTunjangan">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Periode Gaji</th>
                                <th scope="col">Tgl. Pembayaran</th>
                                <?php if (in_groups(['Super admin'])) : ?>
                                    <th scope="col">Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($list) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($list as $list_gaji) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $list_gaji['periode_pembayaran_bulan']; ?>/<?= $list_gaji['periode_pembayaran_tahun']; ?></td>
                                        <td><?= $list_gaji['tgl_pembayaran']; ?></td>
                                        <?php if (in_groups(['Super admin'])) : ?>
                                            <td>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger gaji-delete" data-pengeluaran="<?= $list_gaji['pengeluaran_id']; ?>" data-gaji="<?= $list_gaji['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Penerima -->
<div class="modal fade" id="bayarGajiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarGajiModalLabel">Bayar Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembayarangaji/insert" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="bulan_pembayaran" class="col-12 col-form-label">Bulan Pembayaran</label>
                        <div class="col-12">
                            <select name="bulan_pembayaran" id="bulan_pembayaran" class="form-control custom-select" value="<?= old('bulan_pembayaran'); ?>">
                                <option>Pilih Bulan Pembayaran ...</option>
                                <option value="1" <?= (date('n') == 1) ? 'selected' : ''; ?>>Januari</option>
                                <option value="2" <?= (date('n') == 2) ? 'selected' : ''; ?>>Februari</option>
                                <option value="3" <?= (date('n') == 3) ? 'selected' : ''; ?>>Maret</option>
                                <option value="4" <?= (date('n') == 4) ? 'selected' : ''; ?>>April</option>
                                <option value="5" <?= (date('n') == 5) ? 'selected' : ''; ?>>Mei</option>
                                <option value="6" <?= (date('n') == 6) ? 'selected' : ''; ?>>Juni</option>
                                <option value="7" <?= (date('n') == 7) ? 'selected' : ''; ?>>Juli</option>
                                <option value="8" <?= (date('n') == 8) ? 'selected' : ''; ?>>Agustus</option>
                                <option value="9" <?= (date('n') == 9) ? 'selected' : ''; ?>>September</option>
                                <option value="10" <?= (date('n') == 10) ? 'selected' : ''; ?>>Oktober</option>
                                <option value="11" <?= (date('n') == 11) ? 'selected' : ''; ?>>November</option>
                                <option value="12" <?= (date('n') == 12) ? 'selected' : ''; ?>>Desember</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun_pembayaran" class="col-12 col-form-label">Tahun Pembayaran</label>
                        <div class="col-12">
                            <input type="number" class="form-control" name="tahun_pembayaran" id="tahun_pembayaran" value="<?= date('Y'); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-12 col-form-label">Cara Pembayaran</label>
                        <div class="col-12">
                            <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control custom-select" value="<?= old('jenis_pembayaran'); ?>">
                                <option>Pilih Cara Pembayaran ...</option>
                                <?php foreach ($pembayaran as $pembayaran) : ?>
                                    <option value="<?= $pembayaran['id']; ?>"><?= $pembayaran['nama_jenis_pembayaran']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="gaji_staf_id" class="gaji_staf_id" value="<?= $gaji['id']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteGajiModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGajiModalLabel">Hapus Data Pembayaran Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembayarangaji/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini? Data yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="pembayaran_gaji_id" class="pembayaran_gaji_id">
                    <input type="hidden" name="pengeluaran_id" class="pengeluaran_id">
                    <input type="hidden" name="gaji_staf_id" class="gaji_staf_id" value="<?= $gaji['id']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Tabel penerima tunjangan
    $(document).ready(function() {
        $('#tabelDetailTunjangan').DataTable();
    });

    // Delete data pembayaran gaji
    $('.gaji-delete').on('click', function() {
        // Ambil data btn delete
        const gaji_id = $(this).data('gaji');
        const pengeluaran_id = $(this).data('pengeluaran');
        // Set data ke form delete
        $('.pembayaran_gaji_id').val(gaji_id);
        $('.pengeluaran_id').val(pengeluaran_id);
        // Panggil modal delete
        $('#deleteGajiModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>