<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<!-- <= d($pendapatan_harian, $pendapatan_bulanan); ?> -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-left-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="h4 font-weight-bold text-gray-800 mb-3">
                            Selamat Datang, <?= (user()->full_name) ? user()->full_name : 'Pengguna'; ?>
                        </div>
                        <?php if ($check == 0) : ?>
                            <!-- Profil belum lengkap -->
                            <div class="alert alert-warning">
                                <i class="fas fa-fw fa-exclamation-triangle"></i> Profil Anda belum lengkap. Silakan lengkapi terlebih dahulu. <a href="/user/edit/<?= user()->id; ?>" class="font-weight-bold"><u>Lengkapi &raquo;</u></a>
                            </div>
                        <?php endif; ?>
                        <!-- Sampai disini -->
                        <div class="text">
                            Role Anda:
                            <?php if (in_groups('Super admin')) : ?>
                                <span class="badge badge-success">Super admin</span>
                            <?php elseif (in_groups('Owner')) : ?>
                                <span class="badge badge-primary">Owner</span>
                            <?php elseif (in_groups('Manajer')) : ?>
                                <span class="badge badge-info">Manajer</span>
                            <?php elseif (in_groups('Kasir')) : ?>
                                <span class="badge badge-warning">Kasir</span>
                            <?php elseif (in_groups('Staf')) : ?>
                                <span class="badge badge-danger">Staf</span>
                            <?php else : ?>
                                <span class="badge badge-success">N/A</span>
                            <?php endif; ?>
                        </div>
                        <div class="text mt-3">
                            Akses cepat:
                            <a href="/pengeluaran" class="font-weight-bold mx-2"><u>Pengeluaran</u></a>
                            <?php if (in_groups(['Super admin', 'Manajer', 'Kasir', 'Owner'])) : ?>
                                <a href="/penjualan" class="font-weight-bold mx-2"><u>Penjualan</u></a>
                                <a href="/kas" class="font-weight-bold mx-2"><u>Kas</u></a>
                                <a href="/payroll" class="font-weight-bold mx-2"><u>Payroll</u></a>
                                <a href="/aset" class="font-weight-bold mx-2"><u>Aset</u></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card Informasi -->
<?php if (in_groups(['Super admin', 'Staf', 'Manajer', 'Kasir', 'Owner'])) : ?>
    <div class="row my-2">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan Tgl. <?= date_indo(date('Y-m-j')); ?></div>
                            <?php if (!$pendapatan_harian) : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0,00</div>
                            <?php else : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pendapatan_harian, 2, ',', '.'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pendapatan Bulan <?= month_indo(date('Y-m-j')); ?></div>
                            <?php if (!$pendapatan_bulanan) : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0,00</div>
                            <?php else : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pendapatan_bulanan, 2, ',', '.'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pengeluaran Tgl. <?= date_indo(date('Y-m-j')); ?></div>
                            <?php if (!$pengeluaran_harian) : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0,00</div>
                            <?php else : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pengeluaran_harian, 2, ',', '.'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-funnel-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pengeluaran Bulan <?= month_indo(date('Y-m-j')); ?></div>
                            <?php if (!$pengeluaran_bulanan) : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. 0,00</div>
                            <?php else : ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pengeluaran_bulanan, 2, ',', '.'); ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-funnel-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection(); ?>