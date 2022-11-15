<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<?= d($penjualan); ?>
<a href="/laporan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-lg-6">
        <div class="card mt-3 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body pb-0">
                <form action="/laporan/getpenjualan" id="lap_penjualan" method="post">
                    <div class="form-group row px-2">
                        <label for="periode_penjualan" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-6">
                            <select name="periode_penjualan" id="periode" class="form-control custom-select">
                                <option>Pilih periode penjualan ...</option>
                                <option value="d">Harian</option>
                                <option value="m">Bulanan</option>
                                <option value="y">Tahunan</option>
                                <option value="p">Periode tertentu</option>
                            </select>
                        </div>
                    </div>
                    <div id="form_input"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Preview Laporan</h6>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                            PT. Bali Segara Indah<br>
                                            Laporan Penjualan<br>
                                            <?php if ($penjualan['periode'] == 'd') : ?>
                                                Periode 28-11-2021 - 29-11-2021<br>
                                            <?php elseif ($penjualan['periode'] == 'm') : ?>
                                                Periode 28-11-2021 - 29-11-2021<br>
                                            <?php elseif ($penjualan['periode'] == 'y') : ?>
                                                Periode 28-11-2021 - 29-11-2021<br>
                                            <?php elseif ($penjualan['periode'] == 'p') : ?>
                                                Periode 28-11-2021 - 29-11-2021<br>
                                            <?php else : ?>
                                            <?php endif; ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="col" class="col-6">Nama Produk</th>
                                        <th scope="col" class="col-3">Jumlah</th>
                                        <th scope="col" class="col-3">Total</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
    $("#periode").on('change', function() {
        // console.log($(this).val());
        var pilihan = $(this).val();
        if (pilihan == "d") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row px-2">').append(
                    $('<label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="date" name="tanggal" id="tanggal" class="form-control" required>')
                    ),
                    $('<button class="btn btn-sm btn-primary col-sm-2" type="submit"><i class="fas fa-fw fa-clipboard"></i> Generate</button>')
                )
            );
            // console.log("harian");
        } else if (pilihan == "m") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row px-2">').append(
                    $('<label for="bulan" class="col-sm-2 col-form-label">Bulan</label>'),
                    $('<div class="col-sm-3">').append(
                        $('<select name="bulan" id="bulan" class="form-control custom-select">').append(
                            $('<option>Bulan ...</option>'),
                            $('<option value="01">Januari</option>'),
                            $('<option value="02">Februari</option>'),
                            $('<option value="03">Maret</option>'),
                            $('<option value="04">April</option>'),
                            $('<option value="05">Mei</option>'),
                            $('<option value="06">Juni</option>'),
                            $('<option value="07">Juli</option>'),
                            $('<option value="08">Agustus</option>'),
                            $('<option value="09">September</option>'),
                            $('<option value="10">Oktober</option>'),
                            $('<option value="11">November</option>'),
                            $('<option value="12">Desember</option>'),
                        )
                    ),
                    $('<div class="col-sm-3">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" placeholder="Tahun ..." maxlength="4" required>')
                    ),
                    $('<button class="btn btn-sm btn-primary col-sm-2" type="submit"><i class="fas fa-fw fa-clipboard"></i> Generate</button>')
                )
            );
            // console.log("bulanan");
        } else if (pilihan == "y") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row px-2">').append(
                    $('<label for="tahun" class="col-sm-2 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-3">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" maxlength="4" required>')
                    ),
                    $('<button class="btn btn-sm btn-primary col-sm-2" type="submit"><i class="fas fa-fw fa-clipboard"></i> Generate</button>')
                )
            );
            // console.log("tahunan");
        } else if (pilihan == "p") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row px-2">').append(
                    $('<label for="tanggal_awal" class="col-sm-2 col-form-label">Tanggal</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>')
                    ),
                    $('<label for="tanggal_akhir" class="col-sm-1 col-form-label">s.d.</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>')
                    ),
                    $('<button class="btn btn-sm btn-primary col-sm-2" type="submit"><i class="fas fa-fw fa-clipboard"></i> Generate</button>')
                )
            );
        } else {
            console.log("tidak dipilih");
        }
    });
</script>
<?= $this->endSection(); ?>