<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body">
                <form action="/laporan/generate" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row mb-3">
                        <label for="jenis_laporan" class="col-sm-3 col-form-label">Jenis Laporan</label>
                        <div class="col-sm-9">
                            <select name="jenis_laporan" id="laporan" class="form-control custom-select">
                                <option>Pilih Jenis Laporan ...</option>
                                <option value="penjualan">Laporan Penjualan</option>
                                <option value="labarugi">Laporan Laba-Rugi</option>
                                <option value="aruskas">Laporan Arus Kas</option>
                                <option value="neraca">Laporan Neraca</option>
                                <option value="penyusutan">Laporan Penyusutan</option>
                                <option value="pajak">Laporan Pajak Penghasilan</option>
                            </select>
                        </div>
                    </div>
                    <div id="form_input"></div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Generate</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $("#laporan").on('change', function() {
        console.log($(this).val());
        var pilihan = $(this).val();

        if (pilihan == "penjualan") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tanggal_awal" class="col-sm-3 col-form-label">Periode</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>')
                    ),
                    $('<label for="tanggal_akhir" class="col-sm-1 col-form-label">s.d.</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>')
                    )
                )
            );
        } else if (pilihan == "labarugi") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tahun" class="col-sm-3 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" required>')
                    )
                )
            );
        } else if (pilihan == "aruskas") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tahun" class="col-sm-3 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" required>')
                    )
                )
            );
        } else if (pilihan == "neraca") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tahun" class="col-sm-3 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" required>')
                    ),
                )
            );
        } else if (pilihan == "penyusutan") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tahun" class="col-sm-3 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" required>')
                    ),
                )
            );
        } else if (pilihan == "pajak") {
            $("#form_input").empty();
            $("#form_input").append(
                $('<div class="form-group row">').append(
                    $('<label for="tahun" class="col-sm-3 col-form-label">Tahun</label>'),
                    $('<div class="col-sm-4">').append(
                        $('<input type="number" name="tahun" id="tahun" class="form-control" required>')
                    ),
                )
            );
        } else {
            $("#form_input").empty();
        }
    });
</script>
<?= $this->endSection(); ?>