<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<a href="/penjualan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<div class="row">
    <div class="col-12">
        <div class="card my-3">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
            </div>
            <div class="card-body">
                <form action="/penjualan/datastore" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-3 col-form-label">Tgl. Transaksi</label>
                                <div class="col-sm-9">
                                    <?php if ($customer) : ?>
                                        <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control" value="<?= $customer['tgl_transaksi']; ?>">
                                    <?php else : ?>
                                        <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <?php if ($customer) : ?>
                                        <input type="text" name="nama_customer" id="nama_customer" class="form-control" value="<?= $customer['nama_customer']; ?>">
                                    <?php else : ?>
                                        <input type="text" name="nama_customer" id="nama_customer" class="form-control">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border-left-primary">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total, 2, ',', '.'); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-3 mt-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="produk_id" class="col-sm-3 col-form-label">Nama Produk</label>
                                <div class="col-sm-9">
                                    <select name="produk_id" id="produk_id" class="form-control custom-select">
                                        <option>Pilih Produk ...</option>
                                        <?php foreach ($produk as $p) : ?>
                                            <option value="<?= $p['id']; ?>"><?= $p['nama_produk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga" class="col-sm-3 col-form-label">Harga</label>
                                <div class="col-sm-9">
                                    <input type="number" name="harga" id="harga" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                <div class="col-sm-9">
                                    <input type="number" name="jumlah" id="jumlah" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pajak" class="col-sm-3 col-form-label">Pajak</label>
                                <div class="col-sm-9">
                                    <select name="pajak" class="form-control custom-select" id="pajak">
                                        <option>Pilih Pajak ...</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row ml-1">
                                <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-fw fa-plus"></i> Tambah</button>
                                <button type="reset" class="btn btn-danger ml-1"><i class="fas fa-fw fa-redo"></i> Reset</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="tgl_booking" class="col-sm-3 col-form-label">Tgl. Booking</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_booking" id="tgl_booking" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="total" class="col-sm-3 col-form-label">Total</label>
                                <div class="col-sm-9">
                                    <input type="number" name="total" id="total" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="diskon" class="col-sm-3 col-form-label">Diskon</label>
                                <div class="col-sm-9">
                                    <!-- <input type="number" name="diskon" id="diskon" class="form-control form-inline"> -->
                                    <select name="diskon" id="diskon" class="form-control form-inline">
                                        <option>Pilih Diskon ...</option>
                                        <option value=""></option>
                                    </select>
                                    <!-- </div> -->
                                    <!-- <div class="col-sm-4"> -->
                                    <!-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="disc" id="disc_persen" value="persen">
                                        <label class="form-check-label" for="disc_persen">Persen (%)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="disc" id="disc_harga" value="harga">
                                        <label class="form-check-label" for="disc_harga">Rupiah (Rp.)</label>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- <php if ($customer) {
            d($customer);
        } ?>

        <php if ($cart) {
            d($cart);
        }
        ?> -->

        <div class="card my-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Tgl. Booking</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Diskon</th>
                                    <!-- <th scope="col">Pajak</th> -->
                                    <th scope="col">Total</th>
                                    <?php if ($cart) : ?>
                                        <th scope="col">Aksi</th>
                                    <?php endif; ?>
                                </thead>
                                <tbody>
                                    <?php if ($cart) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($cart as $cart) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td>
                                                    <?php
                                                    $this->builder = db_connect();
                                                    $query = $this->builder->table('produk')
                                                        ->select('nama_produk')
                                                        ->where('produk.id', $cart['produk_id'])
                                                        ->get()->getFirstRow('array');
                                                    $product = $query;
                                                    ?>
                                                    <?= $product['nama_produk']; ?>
                                                </td>
                                                <td><?= $cart['tgl_booking']; ?></td>
                                                <td>Rp. <?= $cart['harga']; ?></td>
                                                <td><?= $cart['jumlah']; ?></td>
                                                <td>Rp. <?= $cart['harga'] * $cart['jumlah']; ?></td>
                                                <!-- <td></td> -->
                                                <td></td>
                                                <td>
                                                    <form action="/penjualan/remove" method="post">
                                                        <input type="hidden" name="produk_id" value="<?= $cart['produk_id']; ?>">
                                                        <input type="hidden" name="tgl_booking" value="<?= $cart['tgl_booking']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <td colspan="7" class="text-center">Belum ada produk</td>
                                    <?php endif; ?>
                                    <?php if ($cart) : ?>
                                        <tr>
                                            <td colspan="8">
                                                <form action="/penjualan/save" method="post" class="d-inline">
                                                    <button class="btn btn-primary mr-1"><i class="fas fa-fw fa-save"></i> Simpan</button>
                                                </form>
                                                <form action="/penjualan/removeall" method="post" class="d-inline">
                                                    <button class="btn btn-danger ml-1"><i class="fas fa-fw fa-times"></i> Batalkan</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-3"></div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#produk_id').select2();
        $('#diskon').select2();
        $('#pajak').select2();

        var harga = 0;
        var jumlah = 0;
        var count = 1;
        var produk = <?= json_encode($produk) ?>;
        // console.log(produk);
        $('#produk_id').change(function() {
            const id = $(this).val();
            produk.forEach(function(item, index) {
                if (item['id'] == id) {
                    // console.log(item['harga_awal']);
                    var harga_awal_produk = item['harga_awal'];
                    harga = harga_awal_produk;
                }
            });
            // console.log(harga);
            $('#jumlah').val(count);
            jumlah = harga * $('#jumlah').val();
            $('#total').val(jumlah);
            $('#harga').val(harga);
        });

        $('#jumlah').change(function() {
            // console.log($(this).val());
            jumlah = harga * $(this).val();
            // console.log(jumlah);
            $('#total').val(jumlah);
        });
    });
</script>
<?= $this->endSection(); ?>