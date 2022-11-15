<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Gaji dan Tunjangan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Gaji Karyawan</div>
                                        <a href="/gaji" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-user-tag fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Tunjangan Karyawan</div>
                                        <a href="/tunjangan" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-user-shield fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Kelola Jenis Tunjangan</div>
                                        <a href="/tunjangan/jenis" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-cog fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notifikasi -->
<!-- Tab -->
<ul class="nav nav-tabs" id="penjualanTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="jual-produk-tab" data-toggle="tab" href="#bayarGaji" role="tab"><i class="fas fa-fw fa-hand-holding-usd"></i> Pembayaran Gaji</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="jual-aset-tab" data-toggle="tab" href="#bayarTunjangan" role="tab"><i class="fas fa-fw fa-hand-holding-usd"></i> Pembayaran Tunjangan</a>
    </li>
</ul>

<!-- Konten tab -->
<div class="tab-content">
    <!-- Pembayaran Gaji -->
    <div class="tab-pane active" id="bayarGaji" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <a href="#" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a> -->
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelBayarGaji">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Staf</th>
                                        <th scope="col">Periode Gaji</th>
                                        <th scope="col">Jumlah Pembayaran</th>
                                        <th scope="col">Tgl. Pembayaran</th>
                                        <!-- <th scope="col">Aksi</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($gaji) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($gaji as $gaji) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $gaji['nama_staf']; ?></td>
                                                <td><?= $gaji['periode_pembayaran_bulan']; ?>/<?= $gaji['periode_pembayaran_tahun']; ?></td>
                                                <td>Rp. <?= number_format($gaji['jumlah_pembayaran'], 2, ',', '.'); ?></td>
                                                <td><?= $gaji['tgl_pembayaran']; ?></td>
                                                <!-- <td>
                                                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                                    <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                                </td> -->
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
    </div>
    <!-- Pembelian aset -->
    <div class="tab-pane" id="bayarTunjangan" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelBayarTunjangan">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Aset</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Test 1</td>
                                        <td>Tombol</td>
                                    </tr>
                                </tbody>
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
<script type="text/javascript">
    // Tabel penjualan produk
    $(document).ready(function() {
        $('#tabelBayarGaji').DataTable();
    });
    // Tabel penjualan aset
    $(document).ready(function() {
        $('#tabelBayarTunjangan').DataTable();
    });
</script>
<?= $this->endSection(); ?>