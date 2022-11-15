<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($pengeluaran, $jenis, $periode); ?> -->
<a href="/pengeluaran" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3 mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body">
                <form action="/pengeluaran/laporan" method="get">
                    <div class="form-group row px-2">
                        <label for="jenis_pengeluaran" class="col-12 col-form-label">Jenis Pengeluaran</label>
                        <div class="col-12">
                            <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control custom-select">
                                <option value="d">Semua jenis</option>
                                <option value="harian">Pengeluaran harian</option>
                                <option value="kas">Pengeluaran kas</option>
                                <option value="aset">Pembelian aset</option>
                            </select>
                        </div>
                        <label for="periode" class="col-12 col-form-label">Periode Laporan</label>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Dari tgl.">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">s.d.</span>
                                </div>
                                <input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Sampai tgl.">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mx-2"><i class="fas fa-fw fa-list"></i> Tampilkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <table class="table table-bordered">
                                <?php if ($jenis == 'default') : ?>
                                    <!-- Default -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Pengeluaran<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= $periode; ?></th>
                                        </tr>
                                        <!-- Harian -->
                                        <tr>
                                            <th colspan="3" class="text-center">Pengeluaran Harian</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['harian']) : ?>
                                            <?php foreach ($pengeluaran['harian'] as $harian) : ?>
                                                <tr>
                                                    <td><?= $harian['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($harian['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($harian['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                        <!-- Aset -->
                                        <tr>
                                            <th colspan="3" class="text-center">Aset</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Nama Aset</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['aset']) : ?>
                                            <?php foreach ($pengeluaran['aset'] as $aset) : ?>
                                                <tr>
                                                    <td><?= $aset['nama_aset']; ?> (<?= $aset['kode_aset']; ?>)</td>
                                                    <td>Rp. <?= number_format($aset['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($aset['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                        <!-- Kas -->
                                        <tr>
                                            <th colspan="3" class="text-center">Kas</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['kas']) : ?>
                                            <?php foreach ($pengeluaran['kas'] as $kas) : ?>
                                                <tr>
                                                    <td><?= $kas['deskripsi']; ?></td>
                                                    <td>Rp. <?= number_format($kas['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($kas['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                <?php elseif ($jenis == 'harian') : ?>
                                    <!-- Harian -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Pengeluaran<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= $periode; ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center">Pengeluaran Harian</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran) : ?>
                                            <?php foreach ($pengeluaran as $harian) : ?>
                                                <tr>
                                                    <td><?= $harian['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($harian['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($harian['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                <?php elseif ($jenis == 'aset') : ?>
                                    <!-- Aset -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Pengeluaran<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= $periode; ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center">Aset</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Nama Aset</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran) : ?>
                                            <?php foreach ($pengeluaran as $aset) : ?>
                                                <tr>
                                                    <td><?= $aset['nama_aset']; ?> (<?= $aset['kode_aset']; ?>)</td>
                                                    <td>Rp. <?= number_format($aset['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($aset['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                <?php elseif ($jenis == 'kas') : ?>
                                    <!-- Kas -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Pengeluaran<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= $periode; ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-center">Kas</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran) : ?>
                                            <?php foreach ($pengeluaran as $kas) : ?>
                                                <tr>
                                                    <td><?= $kas['deskripsi']; ?></td>
                                                    <td>Rp. <?= number_format($kas['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($kas['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                <?php else : ?>
                                    <!-- Semua -->
                                    <thead class="thead-light">
                                        <tr>
                                            <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                                PT. Bali Segara Indah<br>
                                                Laporan Pengeluaran<br>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3">Periode : <?= $periode; ?></th>
                                        </tr>
                                        <!-- Harian -->
                                        <tr>
                                            <th colspan="3" class="text-center">Pengeluaran Harian</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['harian']) : ?>
                                            <?php foreach ($pengeluaran['harian'] as $harian) : ?>
                                                <tr>
                                                    <td><?= $harian['rincian_pengeluaran']; ?></td>
                                                    <td>Rp. <?= number_format($harian['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($harian['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                        <!-- Aset -->
                                        <tr>
                                            <th colspan="3" class="text-center">Aset</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Nama Aset</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['aset']) : ?>
                                            <?php foreach ($pengeluaran['aset'] as $aset) : ?>
                                                <tr>
                                                    <td><?= $aset['nama_aset']; ?> (<?= $aset['kode_aset']; ?>)</td>
                                                    <td>Rp. <?= number_format($aset['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($aset['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                        <!-- Kas -->
                                        <tr>
                                            <th colspan="3" class="text-center">Kas</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class="col-6 text-center">Rincian Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Total Pengeluaran</th>
                                            <th scope="col" class="col-3 text-center">Tgl. Transaksi</th>
                                        </tr>
                                        <?php if ($pengeluaran['kas']) : ?>
                                            <?php foreach ($pengeluaran['kas'] as $kas) : ?>
                                                <tr>
                                                    <td><?= $kas['deskripsi']; ?></td>
                                                    <td>Rp. <?= number_format($kas['total_pengeluaran'], 2, ',', '.'); ?></td>
                                                    <td><?= date_indo($kas['tgl_transaksi']); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="3" class="text-center">Tidak ada data</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>