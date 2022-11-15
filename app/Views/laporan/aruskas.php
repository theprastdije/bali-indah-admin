<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<a href="/laporan" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-lg-4">
        <div class="card mt-3 mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Generate Laporan</h6>
            </div>
            <div class="card-body pb-0">
                <div class="form-group row px-2">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                    <div class="col-sm-6">
                        <input type="number" name="tahun" id="tahun" class="form-control" maxlength="4" required>
                    </div>
                    <button class="btn btn-sm btn-primary col-sm-3"><i class="fas fa-fw fa-clipboard"></i> Generate</button>
                </div>
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
                        <div class="col-lg-10">
                            <p>Data Per 7 November 2021</p>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                            PT. Bali Segara Indah<br>
                                            Laporan Arus Kas<br>
                                            Untuk Tahun yang Berakhir 31 Desember 2021<br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold pb-2">
                                            Arus kas dari aktivitas operasional
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pb-2">
                                            Arus kas dari aktivitas investasi
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold pb-2">
                                            Arus kas dari aktivitas pendanaan
                                        </td>
                                        <td></td>
                                        <td></td>
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