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
                <form action="" method="get">
                    <div class="form-group row px-2">
                        <label for="bulan" class="col-12 col-form-label">Bulan</label>
                        <div class="col-12">
                            <select name="bulan" id="bulan" class="form-control custom-select">
                                <option>Pilih Bulan ...</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">>Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
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
                        <div class="col-lg-10">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="3" class="text-center font-weight-bold text-md text-uppercase">
                                            PT. Bali Segara Indah<br>
                                            Jurnal Umum<br>
                                            Periode April 2022<br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-left font-weight-bold col-3">Tgl. Transaksi</td>
                                        <td class="text-left font-weight-bold col-3">Deskripsi</td>
                                        <td class="text-left font-weight-bold col-3">Debit</td>
                                        <td class="text-left font-weight-bold col-3">Kredit</td>
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