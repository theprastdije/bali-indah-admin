<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($pengeluaran); ?> -->
<div class="row">
    <div class="col-lg-6">
        <a href="/pengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Pengeluaran</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <?php if (in_groups(['Super admin', 'Owner', 'Manajer', 'Kasir'])) : ?>
                                <tr>
                                    <th scope="row">Diajukan Oleh</th>
                                    <td class="font-weight-bold"><?= $pengajuan['nama_staf']; ?> (<?= $pengajuan['username']; ?>)</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th scope="row">Tanggal Transaksi</th>
                                <td><?= $pengajuan['tgl_transaksi']; ?></td>
                            </tr>
                            <tr>
                                <!-- Join tb akun -->
                                <th scope="row">Kode Akun</th>
                                <td>(<?= $pengajuan['kategori_akun']; ?>-<?= $pengajuan['kode_akun']; ?>) <?= $pengajuan['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Keperluan Pengeluaran</th>
                                <td><?= $pengajuan['rincian_pengeluaran']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Harga Satuan</th>
                                <td>Rp. <?= number_format($pengajuan['harga_satuan'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah</th>
                                <td><?= $pengajuan['jumlah']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Total</th>
                                <td>Rp. <?= number_format($pengajuan['total_pengeluaran'], 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Catatan</th>
                                <td><?= $pengajuan['catatan']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Bukti Pengeluaran</th>
                                <?php if ($pengajuan['bukti_pengeluaran']) : ?>
                                    <td><a href="/file/bukti-pengeluaran/<?= $pengajuan['bukti_pengeluaran']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-eye"></i> Lihat File</a></td>
                                <?php else : ?>
                                    <td>File tidak ditemukan</td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th scope="row">Status Pengajuan</th>
                                <td>
                                    <?php if ($pengajuan['status_pengajuan'] == '0') : ?>
                                        <span class="badge badge-secondary">Diproses</span>
                                    <?php elseif ($pengajuan['status_pengajuan'] == '1') : ?>
                                        <span class="badge badge-success">Diterima</span>
                                    <?php elseif ($pengajuan['status_pengajuan'] == '2') : ?>
                                        <span class="badge badge-danger">Ditolak</span>
                                    <?php else : ?>
                                        <span class="badge badge-secondary">Tidak valid</span>
                                    <?php endif ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>