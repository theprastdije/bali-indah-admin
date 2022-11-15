<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Tampilkan Laporan</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card bg-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-white text-uppercase mb-1">Laporan Jurnal</div>
                                        <a href="#" class="mb-0 font-weight-bold text-white">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-clipboard-list fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card bg-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-white text-uppercase mb-1">Laporan Buku Besar</div>
                                        <a href="#" class="mb-0 font-weight-bold text-white">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-book fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card bg-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-white text-uppercase mb-1">Laporan Laba Rugi</div>
                                        <a href="/laporan/labarugi" class="mb-0 font-weight-bold text-white">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-coins fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card bg-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-white text-uppercase mb-1">Laporan Arus Kas</div>
                                        <a href="/laporan/aruskas" class="mb-0 font-weight-bold text-white">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-chart-bar fa-2x text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-1">
                        <div class="card bg-success h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-sm font-weight-bold text-white text-uppercase mb-1">Laporan Neraca</div>
                                        <a href="/laporan/neraca" class="mb-0 font-weight-bold text-white">Lihat &raquo;</a>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fa-balance-scale fa-2x text-white"></i>
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>