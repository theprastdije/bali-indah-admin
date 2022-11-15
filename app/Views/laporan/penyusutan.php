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
                        <div class="col-12">
                            <p>Data Per 12 November 2021</p>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="6" class="text-center font-weight-bold text-md text-uppercase">
                                            PT. Bali Segara Indah<br>
                                            Daftar Penyusutan dan Amortisasi Fiskal<br>
                                            31 Desember 2021<br>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th scope="col">Nama Aset</th>
                                        <th scope="col">Tahun Perolehan</th>
                                        <th scope="col">Harga Perolehan</th>
                                        <th scope="col">Nilai Sisa Buku Fiskal</th>
                                        <th scope="col">Metode Penyusutan (Fiskal/Komersial)</th>
                                        <th scope="col">Penyusutan Fiskal Tahun Ini</th>
                                    </tr>
                                    <!-- Kelompok 1 -->
                                    <?php if ($aset_nb1) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bukan Bangunan - Kelompok 1</p>
                                            </th>
                                        </tr>
                                        <?php foreach ($aset_nb1 as $nb1) : ?>
                                            <tr>
                                                <td class="py-1"><?= $nb1['nama_aset']; ?></td>
                                                <td class="py-1"><?= $nb1['tahun_perolehan']; ?></td>
                                                <td class="py-1">Rp. <?= number_format($nb1['harga_perolehan'], 2, ',', '.'); ?></td>
                                                <!-- Nilai Sisa Buku -->
                                                <td class="py-1">
                                                    <?php
                                                    $selisih = intval($tahun) - intval($nb1['tahun_perolehan']);
                                                    // Fiskal
                                                    if ($nb1['metode_penyusutan_fiskal'] == "gl") {
                                                        if ($selisih <= intval($nb1['masa_manfaat_fiskal']) && $selisih > 0) {
                                                            $nbf1 = floatval($nb1['harga_perolehan']) - (floatval($selisih) * floatval($nb1['harga_perolehan']) * floatval($nb1['persen_penyusutan_fiskal'] / 100));
                                                        } elseif ($selisih == 0) {
                                                            $nbf1 = floatval($nb1['harga_perolehan']);
                                                        } else {
                                                            $nbf1 = floatval(0);
                                                        }
                                                    } elseif ($nb1['metode_penyusutan_fiskal'] == "sm") {
                                                        $penyusutan = 0;
                                                        $penyusutan_trkh = 0;
                                                        $iterasi = intval($tahun) - intval($nb1['tahun_perolehan']) + 1;
                                                        if ($iterasi >= intval($nb1['masa_manfaat_fiskal'])) {
                                                            $nbf1 = floatval(0);
                                                        } else {
                                                            for ($i = 1; $i <= $iterasi; $i++) {
                                                                $penyusutan_trkh = (floatval($nb1['harga_perolehan']) - $penyusutan) * floatval($nb1['persen_penyusutan_fiskal'] / 100);
                                                                $penyusutan = $penyusutan + $penyusutan_trkh;
                                                            }
                                                            $nbf1 = floatval($nb1['harga_perolehan']) - $penyusutan;
                                                        }
                                                    } else {
                                                        $nbf1 = floatval(0);
                                                    }
                                                    echo "Rp. " . number_format($nbf1, 2, ',', '.');
                                                    // Komersial
                                                    if ($nb1['metode_penyusutan_komersial'] == "gl") {
                                                        if ($selisih <= intval($nb1['masa_manfaat_komersial']) && $selisih > 0) {
                                                            $nbk1 = floatval($nb1['harga_perolehan']) - (floatval($selisih) * floatval($nb1['harga_perolehan']) * floatval($nb1['persen_penyusutan_komersial'] / 100));
                                                        } elseif ($selisih == 0) {
                                                            $nbk1 = floatval($nb1['harga_perolehan']);
                                                        } else {
                                                            $nbk1 = floatval(0);
                                                        }
                                                    } elseif ($nb1['metode_penyusutan_komersial'] == "sm") {
                                                        $penyusutan = 0;
                                                        $penyusutan_trkh = 0;
                                                        $iterasi = intval($tahun) - intval($nb1['tahun_perolehan']) + 1;
                                                        if ($iterasi >= intval($nb1['masa_manfaat_fiskal'])) {
                                                            $nbk1 = floatval(0);
                                                        } else {
                                                            for ($i = 1; $i <= $iterasi; $i++) {
                                                                $penyusutan_trkh = (floatval($nb1['harga_perolehan']) - $penyusutan) * floatval($nb1['persen_penyusutan_fiskal'] / 100);
                                                                $penyusutan = $penyusutan + $penyusutan_trkh;
                                                            }
                                                            $nbk1 = floatval($nb1['harga_perolehan']) - $penyusutan;
                                                        }
                                                    } else {
                                                        $nbk1 = floatval(0);
                                                    }
                                                    ?>
                                                </td>
                                                <td class="py-1">
                                                    <!-- Fiskal -->
                                                    <?php if ($nb1['metode_penyusutan_fiskal'] == "gl") : ?>
                                                        Garis Lurus /
                                                    <?php elseif ($nb1['metode_penyusutan_fiskal'] == "sm") : ?>
                                                        Saldo Menurun /
                                                    <?php else : ?>
                                                        - /
                                                    <?php endif; ?>
                                                    <!-- Komersial -->
                                                    <?php if ($nb1['metode_penyusutan_komersial'] == "gl") : ?>
                                                        Garis Lurus
                                                    <?php elseif ($nb1['metode_penyusutan_komersial'] == "sm") : ?>
                                                        Saldo Menurun
                                                    <?php else : ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <!-- Penyusutan Tahun Ini -->
                                                <td class="py-1">
                                                    <?php
                                                    // Fiskal
                                                    if ($nb1['metode_penyusutan_fiskal'] == "gl") {
                                                        if ($selisih <= intval($nb1['masa_manfaat_fiskal']) && $selisih > 0) {
                                                            $np1 = floatval($nb1['persen_penyusutan_fiskal']) / 100 * floatval($nb1['harga_perolehan']);
                                                        } else {
                                                            $np1 = floatval(0);
                                                        }
                                                    } elseif ($nb1['metode_penyusutan_fiskal'] == "sm") {
                                                        $penyusutan = 0;
                                                        $penyusutan_trkh = 0;
                                                        $iterasi = intval($tahun) - intval($nb1['tahun_perolehan']) + 1;
                                                        if ($iterasi >= intval($nb1['masa_manfaat_fiskal'])) {
                                                            $np1 = floatval(0);
                                                        } elseif ($iterasi < intval($nb1['masa_manfaat_fiskal']) && $iterasi > 0) {
                                                            for ($i = 1; $i <= $iterasi; $i++) {
                                                                $penyusutan_trkh = (floatval($nb1['harga_perolehan']) - $penyusutan) * floatval($nb1['persen_penyusutan_fiskal'] / 100);
                                                                $penyusutan = $penyusutan + $penyusutan_trkh;
                                                            }
                                                            $np1 = $penyusutan_trkh;
                                                        } else {
                                                            $np1 = floatval(0);
                                                        }
                                                    } else {
                                                        $np1 = floatval(0);
                                                    }
                                                    echo "Rp. " . number_format($np1, 2, ',', '.');
                                                    // Komersial
                                                    if ($selisih <= intval($nb1['masa_manfaat_komersial']) && $selisih > 0) {
                                                        $np1 = floatval($nb1['persen_penyusutan_komersial']) / 100 * floatval($nb1['harga_perolehan']);
                                                    } else {
                                                        $np1 = floatval(0);
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <!-- Kelompok 2 -->
                                    <?php if ($aset_nb2) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bukan Bangunan - Kelompok 2</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <!-- Kelompok 3 -->
                                    <?php if ($aset_nb3) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bukan Bangunan - Kelompok 3</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <!-- Kelompok 4 -->
                                    <?php if ($aset_nb4) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bukan Bangunan - Kelompok 4</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <!-- Bangunan Permanen -->
                                    <?php if ($aset_bp) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bangunan Permanen</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <!-- Bangunan Tidak Permanen -->
                                    <?php if ($aset_btp) : ?>
                                        <tr>
                                            <th scope="col" colspan="6" class="py-0">
                                                <p class="mb-0">Bangunan Tidak Permanen</p>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th scope="col" colspan="2" class="py-0 text-right">Total</th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php else : ?>
                                    <?php endif; ?>
                                    <tr>
                                        <th scope="col" colspan="5" class="py-0 text-right">Total Penyusutan Fiskal</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="col" colspan="5" class="py-0 text-right">Total Penyusutan Komersial</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="col" colspan="5" class="py-0 text-right">Selisih Penyusutan</th>
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

<?= $this->endSection(); ?>