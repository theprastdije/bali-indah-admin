<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<a href="/penjualan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
<form action="/penjualan/insert" method="post">
    <?= csrf_field(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="tgl_transaksi" class="col-sm-3 col-form-label">Tgl. Transaksi</label>
                                <div class="col-sm-9">
                                    <input type="date" name="tgl_transaksi" id="tgl_transaksi" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_customer" id="nama_customer" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="pajak_penjualan" class="col-sm-3 col-form-label">Pajak Penjualan</label>
                                <div class="col-sm-9">
                                    <select class="form-control custom-select" name="pajak_penjualan" id="pajak_penjualan" onchange="get_pajak(this)">
                                        <option value="0">Pilih Pajak Penjualan ...</option>
                                        <?php foreach ($pajak as $pajak_penjualan) : ?>
                                            <option value="<?= $pajak_penjualan['id']; ?>"><?= $pajak_penjualan['jenis_pajak']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
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
                </div>
            </div>

            <div class="card my-3">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Produk</h6>
                </div>
                <div class="card-body" id="carts">
                    <div class="row" id="cart_row">
                        <div class="col-12" id="cart">
                            <div class="form-group d-flex" id="formcart">
                                <select class="form-control custom-select mx-1" name="nama_produk[]" id="nama_produk" onchange="ambil_produk(this, 0)">
                                    <option>Nama Produk ...</option>
                                    <?php foreach ($produk as $product) : ?>
                                        <option value="<?= $product['id']; ?>"><?= $product['nama_produk']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="number" class="form-control mx-1" name="harga_jual[]" id="harga_jual0" placeholder="Harga Produk" readonly>
                                <input type="number" class="form-control mx-1" name="qty[]" id="qty0" placeholder="Jumlah" onchange="hitung_jumlah(this, 0)">
                                <select class="form-control custom-select mx-1" name="diskon_produk[]" id="diskon_produk" onchange="ambil_diskon(this, 0)">
                                    <option value="0">Diskon ...</option>
                                    <?php foreach ($diskon as $discount) : ?>
                                        <option value="<?= $discount['id']; ?>"><?= $discount['nama_diskon']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="date" class="form-control mx-1" name="tgl_booking[]" id="tgl_booking" placeholder="Tgl. Booking">
                                <input type="number" class="form-control mx-1" name="total_harga[]" id="total_harga0" onchange="total_trx(this)" placeholder="Total" readonly>
                                <button type="button" class="btn btn-success mx-1" id="btn-plus" onclick="btn_plus()"><i class="fas fa-fw fa-plus"></i></button>
                                <button type="button" class="btn btn-danger mx-1" id="btn-minus" onclick="btn_minus()"><i class="fas fa-fw fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group row mx-2">
                                <label for="catatan" class="col-form-label">Catatan</label>
                                <textarea name="catatan" id="catatan" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <table class="table table-borderless d-flex justify-content-end px-3">
                                <tbody>
                                    <tr>
                                        <th scope="row">Total</th>
                                        <td>:</td>
                                        <td id="grand_total">Rp. 0</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pajak</th>
                                        <td>:</td>
                                        <td id="trf_pajak">-</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Grand Total</th>
                                        <td>:</td>
                                        <th scope="row" id="gtotal">Rp. 0</th>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row d-flex justify-content-end px-3">
                                <a href="#" class="btn btn-primary mx-1 btn-bayar" data-toggle="modal"><i class="fas fa-fw fa-dollar-sign"></i> Bayar</a>
                                <button type="reset" class="btn btn-danger mx-1"><i class="fas fa-fw fa-times"></i> Batalkan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Bayar -->
    <div class="modal fade" id="bayarModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bayarModalLabel">Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <label for="subtotal" class="col-form-label col-12">Subtotal</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="subtotal" id="subtotal" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label for="total_belanja" class="col-form-label col-12">Total Belanja</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="total_belanja" id="total_belanja" placeholder="0" readonly>
                    </div>
                    <div class="input-group">
                        <label for="jenis_pembayaran" class="col-form-label col-12">Jenis Pembayaran</label>
                        <select class="form-control custom-select" name="jenis_pembayaran" id="jenis_pembayaran" required>
                            <option>Jenis Pembayaran ...</option>
                            <?php foreach ($jenis_pembayaran as $payment) : ?>
                                <option value="<?= $payment['id']; ?>"><?= $payment['nama_jenis_pembayaran']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="jml_bayar" class="col-form-label col-12">Jumlah Pembayaran</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="jml_bayar" id="jml_bayar" placeholder="0" onchange="hitung_kembalian(this)">
                    </div>
                    <div class="input-group">
                        <label for="kembalian" class="col-form-label col-12">Kembali</label>
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="number" class="form-control" name="kembalian" id="kembalian" placeholder="0" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-trash"></i> Bayar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    var produk = <?= json_encode($produk); ?>;
    var diskon = <?= json_encode($diskon); ?>;
    var pajak = <?= json_encode($pajak); ?>;
    var subtotal = 0;
    var grandtotal = 0;
    var id = 0;
    // console.log(produk, diskon);

    function get_pajak(e) {
        var nilai_pajak = 0;
        $.each(pajak, function(index, value) {
            if (value['id'] == e.value) {
                nilai_pajak = value['tarif_pajak'];
            }
        });
        $('#trf_pajak').text(nilai_pajak + '%');

        // console.log(subtotal);
        grandtotal = subtotal + (subtotal * nilai_pajak / 100);
        // console.log(grandtotal);
        var angka = grandtotal;
        var number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        $('#gtotal').text('Rp. ' + rupiah);

        $('#total_belanja').val(grandtotal);
        $('#subtotal').val(subtotal);

    }

    function hitung_kembalian(e) {
        // console.log(e.value);
        grandtotal -= e.value;
        // console.log(grandtotal);
        $('#kembalian').val(grandtotal * -1);
    }

    function btn_plus() {
        id++;
        var id_real = 'cart-' + id
        // console.log(id_real);
        $('#cart_row').append(
            $('<div class="col-12" id="' + id_real + '">').append(
                $('<div class="form-group d-flex" id="formcart">').append(
                    $('<select class="form-control custom-select mx-1" name="nama_produk[]" id="nama_produk" onchange="ambil_produk(this, ' + id + ')">').append(function() {
                        var html = '<option>Nama Produk ...</option>';
                        $.each(produk, function(index, value) {
                            html += `<option value="${value['id']}">${value['nama_produk']}</option>`
                        })
                        return html;
                    }, ),
                    $('<input type="number" class="form-control mx-1" name="harga_jual[]" id="harga_jual' + id + '" placeholder="Harga Produk" readonly>'),
                    $('<input type="number" class="form-control mx-1" name="qty[]" id="qty' + id + '" placeholder="Jumlah" onchange="hitung_jumlah(this, ' + id + ')">'),
                    $('<select class="form-control custom-select mx-1" name="diskon_produk[]" id="diskon_produk" onchange="ambil_diskon(this, ' + id + ')">').append(function() {
                        var html_disc = '<option value="0">Diskon ...</option>';
                        $.each(diskon, function(index, value) {
                            html_disc += `<option value="${value['id']}">${value['nama_diskon']}</option>`
                        })
                        return html_disc;
                    }, ),
                    $('<input type="date" class="form-control mx-1" name="tgl_booking[]" id="tgl_booking" placeholder="Tgl. Booking">'),
                    $('<input type="number" class="form-control mx-1" name="total_harga[]" id="total_harga' + id + '" onchange="total_trx(this)" placeholder="Total">'),
                    $('<button type="button" class="btn btn-success mx-1" id="btn-plus" onclick="btn_plus()"><i class="fas fa-fw fa-plus"></i></button>'),
                    $('<button type="button" class="btn btn-danger mx-1" id="btn-minus" onclick="btn_minus(\'' + id_real + '\')"><i class="fas fa-fw fa-trash"></i></button>')
                )
            )
        )
    }

    function btn_minus(cart_id) {
        var split = cart_id.split('-');
        $('#total_harga' + split[1]);

        subtotal -= $('#total_harga' + split[1]).val();
        // console.log(subtotal);
        var angka = subtotal;
        var number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        $('#grand_total').text('Rp. ' + rupiah);

        $('#' + cart_id).empty();

        var $total_trx = $('#pajak_penjualan');
        $total_trx.trigger('change');
    }

    function ambil_produk(e, col) {
        var harga_produk = 0;
        $('*[id*=harga_jual]:visible').each(function() {
            if ($(this).attr('id') == 'harga_jual' + col) {
                $.each(produk, function(index, value) {
                    if (value['id'] == e.value) {
                        harga_produk = value['harga_produk'];
                    }
                });
                $(this).val(harga_produk);
            }
        });
    }

    function ambil_diskon(e, col) {
        var harga_produk = 0;
        var satuan_diskon = '';
        var jumlah_diskon = 0;
        var jumlah = 0;
        var total = 0;
        $('*[id*=total_harga]:visible').each(function() {
            harga_produk = $('#harga_jual' + col).val();
            jumlah = $('#qty' + col).val();
            $.each(diskon, function(index, value) {
                if (value['id'] == e.value) {
                    satuan_diskon = value['satuan_diskon'];
                    jumlah_diskon = value['jumlah_diskon'];
                }
            });
            if ($(this).attr('id') == 'total_harga' + col) {
                if (satuan_diskon == 'persen') {
                    total = (harga_produk * jumlah) - (harga_produk * jumlah * jumlah_diskon / 100);
                } else if (satuan_diskon == 'jumlah') {
                    total = (harga_produk * jumlah) - jumlah_diskon;
                } else {
                    total = harga_produk * jumlah;
                }
                $(this).val(total);

                var $total_trx = $(this);
                $total_trx.trigger('change');
            }
        });
    }

    function hitung_jumlah(e, col) {
        var harga_produk = 0;
        var jumlah = 0;
        var total = 0;

        $('*[id*=total_harga]:visible').each(function() {
            harga_produk = $('#harga_jual' + col).val();
            jumlah = $('#qty' + col).val();
            // console.log(harga_produk, jumlah);
            if ($(this).attr('id') == 'total_harga' + col) {
                total = harga_produk * jumlah;
                $(this).val(total);

                var $total_trx = $(this);
                $total_trx.trigger('change');
            }
        });
        // console.log(temp_jumlah);
    }

    function total_trx(e) {
        var total = 0;
        $('*[id*=total_harga]:visible').each(function() {
            // console.log($(this).val());
            total += parseFloat($(this).val());
            // 
        });

        subtotal = total;
        var angka = total;
        var number_string = angka.toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        // console.log(parseFloat(total));
        $('#grand_total').text('Rp. ' + rupiah);

        var $total_trx = $('#pajak_penjualan');
        $total_trx.trigger('change');
    }

    $(document).ready(function() {
        // Bayar
        $('.btn-bayar').on('click', function() {
            $('#bayarModal').modal('show');

            var temp_jumlah = 0;
            var qty_produk = 0;

            // $('*[id*=qty]:visible').each(function() {
            //     temp_jumlah = $(this).val();
            //     console.log(temp_jumlah);
            //     qty_produk += parseInt(temp_jumlah);
            // });
            // $('#total_item').val(qty_produk);
        });
    });
</script>
<?= $this->endSection(); ?>