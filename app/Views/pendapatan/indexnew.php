<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>

<!-- Notifikasi -->
<!-- Tab -->
<ul class="nav nav-tabs" id="penjualanTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="jual-produk-tab" data-toggle="tab" href="#jualProduk" role="tab"><i class="fas fa-fw fa-coins"></i> Penjualan Produk</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="jual-aset-tab" data-toggle="tab" href="#jualAset" role="tab"><i class="fas fa-fw fa-people-carry"></i> Penjualan Aset</a>
    </li>
</ul>

<!-- Konten tab -->
<div class="tab-content">
    <!-- Penjualan produk -->
    <div class="tab-pane active" id="jualProduk" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-1">
                                <div class="card h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-sm font-weight-bold text-uppercase mb-1">Penjualan Produk</div>
                                                <a href="/penjualan" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-fw fa-dollar-sign fa-2x"></i>
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
        <!-- <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="/penjualan" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data</a>
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelJualProduk">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Test</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Ubah</a>
                                            <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    <!-- Pembelian aset -->
    <div class="tab-pane" id="jualAset" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover" id="tabelJualAset">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Aset</th>
                                        <th scope="col">Tgl. Perolehan</th>
                                        <th scope="col">Harga Perolehan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($aset) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($aset as $aset_item) : ?>
                                            <tr>
                                                <th scope="row"><?= $i++; ?></th>
                                                <td><?= $aset_item['nama_aset']; ?></td>
                                                <td><?= $aset_item['tgl_perolehan']; ?></td>
                                                <td>Rp. <?= number_format($aset_item['harga_perolehan'], 2, ',', '.'); ?></td>
                                                <td>
                                                    <a href="/penjualanaset/add/<?= $aset_item['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-dollar-sign"></i> Jual</a>
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
    </div>
</div>

<!-- <div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Produk dan Diskon</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Produk</div>
                                        <a href="/produk" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-tag fa-2x"></i>
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
                                        <div class="text-sm font-weight-bold text-uppercase mb-1">Diskon</div>
                                        <a href="/diskon" class="mb-0 font-weight-bold">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-percent fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Tabel penjualan produk
    $(document).ready(function() {
        $('#tabelJualProduk').DataTable();
    });
    // Tabel penjualan aset
    $(document).ready(function() {
        $('#tabelJualAset').DataTable();
    });
</script>
<?= $this->endSection(); ?>