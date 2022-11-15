<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/aset/category" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-body mt-2">
                <h5 class="pb-2">Detail Kategori Aset</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row">Kode Akun</th>
                                <td>(<?= $kategori['kode_akun']; ?>) <?= $kategori['nama_akun']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Kategori Aset</th>
                                <td><?= $kategori['nama_kategori_aset']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Jenis Aset</th>
                                <td>
                                    <?php if ($kategori['jenis_aset'] == "nb1") : ?>
                                        Bukan Bangunan - Kelompok 1
                                    <?php elseif ($kategori['jenis_aset'] == "nb2") : ?>
                                        Bukan Bangunan - Kelompok 2
                                    <?php elseif ($kategori['jenis_aset'] == "nb3") : ?>
                                        Bukan Bangunan - Kelompok 3
                                    <?php elseif ($kategori['jenis_aset'] == "nb4") : ?>
                                        Bukan Bangunan - Kelompok 4
                                    <?php elseif ($kategori['jenis_aset'] == "bp") : ?>
                                        Bangunan Permanen
                                    <?php elseif ($kategori['jenis_aset'] == "btp") : ?>
                                        Bangunan Tidak Permanen
                                    <?php else : ?>
                                        Belum diatur
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Masa Manfaat (Fiskal/Komersial)</th>
                                <td><?= $kategori['masa_manfaat_fiskal']; ?> tahun / <?= $kategori['masa_manfaat_komersial']; ?> tahun</td>
                            </tr>
                            <tr>
                                <th scope="row">Metode Penyusutan (Fiskal/Komersial)</th>
                                <td>
                                    <?php if ($kategori['metode_penyusutan_fiskal'] == "gl") : ?>
                                        Garis Lurus /
                                    <?php elseif ($kategori['metode_penyusutan_fiskal'] == "sm") : ?>
                                        Saldo Menurun /
                                    <?php else : ?>
                                        Belum diatur /
                                    <?php endif; ?>
                                    <?php if ($kategori['metode_penyusutan_komersial'] == "gl") : ?>
                                        Garis Lurus
                                    <?php elseif ($kategori['metode_penyusutan_komersial'] == "sm") : ?>
                                        Saldo Menurun
                                    <?php else : ?>
                                        Belum diatur
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Nilai Penyusutan (Fiskal/Komersial)</th>
                                <td><?= $kategori['persen_penyusutan_fiskal']; ?>% / <?= $kategori['persen_penyusutan_komersial']; ?>%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>