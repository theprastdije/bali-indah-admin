<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($tunjangan, $tunjangan_staf); ?> -->
<?php

use App\Models\PembayaranTunjanganModel;

$this->tunjanganBayarModel = new PembayaranTunjanganModel()
?>

<div class="row">
    <div class="col-lg-6">
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('tunjangan')) : ?>
            <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('tunjangan'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error_tjg')) : ?>
            <div class="alert alert-danger"><i class="fas fa-fw fa-times-circle"></i> <b>ERROR:</b> <?= session()->getFlashdata('error_tjg'); ?></div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12 mb-3">
        <a href="/tunjangan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($tunjangan['status_tunjangan'] == '1') : ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahStafModal"><i class="fas fa-fw fa-plus"></i> Tambah Penerima</button>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Tunjangan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Kiri -->
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row" class="col-3">Nama Tunjangan</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8"><?= $tunjangan['jenis_tunjangan']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Periode Pembayaran</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8">
                                        <?php if ($tunjangan['periode_tunjangan'] == "harian") : ?>
                                            Harian
                                        <?php elseif ($tunjangan['periode_tunjangan'] == "bulanan") : ?>
                                            Bulanan
                                        <?php elseif ($tunjangan['periode_tunjangan'] == "tahunan") : ?>
                                            Tahunan
                                        <?php elseif ($tunjangan['periode_tunjangan'] == "sekali") : ?>
                                            Sekali
                                        <?php else : ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Jumlah Tunjangan</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8">Rp. <?= number_format($tunjangan['jumlah_tunjangan'], 2, ',', '.'); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Kanan -->
                    <div class="col-lg-6">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row" class="col-3">Kode Akun</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8"><?= $tunjangan['kategori_akun']; ?>-<?= $tunjangan['kode_akun']; ?> - <?= $tunjangan['nama_akun']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="col-3">Status</th>
                                    <td class="col-1">:</td>
                                    <td class="col-8">
                                        <?php if ($tunjangan['status_tunjangan'] == "0") : ?>
                                            <span class="badge badge-danger">Tidak aktif</span>
                                        <?php elseif ($tunjangan['status_tunjangan'] == "1") : ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php else : ?>
                                            <span class="badge badge-danger">Tidak valid</span>
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
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Penerima Tunjangan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-1">
                    <table class="table table-hover" id="tabelDetailTunjangan">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Staf</th>
                                <th scope="col">Tgl. Ditambahkan</th>
                                <th scope="col">Status Pembayaran</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($tunjangan_staf) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($tunjangan_staf as $data_staf) : ?>
                                    <?php $getdate = strtotime($data_staf['created_at']); ?>
                                    <?php $date = date('d M Y', $getdate); ?>
                                    <?php
                                    if ($tunjangan['periode_tunjangan'] == "harian") {
                                        $check = $this->tunjanganBayarModel->cekTjgHariAuto($data_staf['id']);
                                    } elseif ($tunjangan['periode_tunjangan'] == "bulanan") {
                                        $check = $this->tunjanganBayarModel->cekTjgBulanAuto($data_staf['id']);
                                    } elseif ($tunjangan['periode_tunjangan'] == "tahunan") {
                                        $check = $this->tunjanganBayarModel->cekTjgTahunAuto($data_staf['id']);
                                    } else {
                                        $check = $this->tunjanganBayarModel->cekTjgSekali($data_staf['id']);
                                    }
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $data_staf['nama_staf']; ?></td>
                                        <td><?= $date; ?></td>
                                        <td>
                                            <?php if ($check['total'] == '1') : ?>
                                                <span class="badge badge-success">Sudah dibayar</span>
                                            <?php else : ?>
                                                <span class="badge badge-danger">Belum dibayar</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger staf-delete" data-tunjangan="<?= $data_staf['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                            <?php if ($tunjangan['status_tunjangan'] == '1') : ?>
                                                <?php if ($tunjangan['periode_tunjangan'] == "sekali") : ?>
                                                    <?php if ($check == '0') : ?>
                                                        <button class="btn btn-sm btn-primary bayar-tjg" data-staf="<?= $data_staf['id']; ?>"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-sm btn-primary bayar-tjg" disabled><i class="fas fa-fw fa-dollar-sign"></i> Bayar</button>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <button class="btn btn-sm btn-primary bayar-tjg" data-staf="<?= $data_staf['id']; ?>"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
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
<div class="modal fade" id="tambahStafModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambaStafModalLabel">Tambah Staf Penerima Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tunjangan/insert" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_staf" class="col-12 col-form-label">Nama Staf</label>
                        <div class="col-12">
                            <select name="nama_staf" id="nama_staf" class="form-control custom-select" value="<?= old('nama_staf'); ?>">
                                <option>Pilih Staf ...</option>
                                <?php foreach ($staf as $staf) : ?>
                                    <option value="<?= $staf['id']; ?>" <?= ($staf['id'] == old('nama_staf') ? 'selected' : ''); ?>><?= $staf['nama_staf']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tunjangan_id" class="tunjangan_id" value="<?= $tunjangan['id']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Bayar Tunjangan -->
<div class="modal fade" id="bayarTjgModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bayarTjgModalLabel">Bayar Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/pembayarantunjangan/insert" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="tgl_pembayaran" class="col-12 col-form-label">Tgl. Pembayaran</label>
                        <div class="col-12">
                            <input type="date" class="form-control" name="tgl_pembayaran" id="tgl_pembayaran">
                        </div>
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
                    <input type="hidden" name="tunjangan_staf_id" class="tunjangan_staf_id">
                    <input type="hidden" name="tunjangan_id" class="tunjangan_id" value="<?= $tunjangan['id']; ?>">
                    <input type="hidden" name="periode_tunjangan" class="periode_tunjangan" value="<?= $tunjangan['periode_tunjangan']; ?>">
                    <input type="hidden" name="jumlah_tunjangan" class="jumlah_tunjangan" value="<?= $tunjangan['jumlah_tunjangan']; ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteStafModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStafModalLabel">Hapus Penerima Tunjangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/tunjangan/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus staf ini dari penerima tunjangan?</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="tunjangan_staf_id" class="tunjangan_staf_id">
                    <input type="hidden" name="tunjangan_id" class="tunjangan_id" value="<?= $tunjangan['id']; ?>">
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

    // Delete penerima tunjangan
    $('.staf-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('tunjangan');
        // Set data ke form delete
        $('.tunjangan_staf_id').val(id);
        // Panggil modal delete
        $('#deleteStafModal').modal('show');
    });

    // Bayar tunjangan
    $('.bayar-tjg').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('staf');
        // Set data ke form delete
        $('.tunjangan_staf_id').val(id);
        // Panggil modal delete
        $('#bayarTjgModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>