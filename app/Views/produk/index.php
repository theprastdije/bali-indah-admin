<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12 mb-3">
        <a href="/penjualan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6">
                <?php if (session()->getFlashdata('produk')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('produk'); ?></div>
                <?php endif; ?>
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <a href="/produk/add" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Produk</a>
                <a href="/produk/category" class="btn btn-primary mb-3"><i class="fas fa-fw fa-cog"></i> Kelola Kategori</a>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabelProduk">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga Produk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($produk) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($produk as $produk) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $produk['nama_produk']; ?></td>
                                        <td>Rp. <?= number_format($produk['harga_produk'], 2, ',', '.'); ?></td>
                                        <td>
                                            <a href="/produk/detail/<?= $produk['id']; ?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/produk/edit/<?= $produk['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger produk-delete" data-prod-id="<?= $produk['id']; ?>"><i class="fas fa-fw fa-trash-alt"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Delete -->
<div class="modal fade" id="deleteProdukModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProdukModalLabel">Hapus Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/produk/delete" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk ini? Produk yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="produk_id" class="produk_id">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    // Tabel produk
    $(document).ready(function() {
        $('#tabelProduk').DataTable();
    });

    // Delete produk
    $('.produk-delete').on('click', function() {
        // Ambil data btn delete
        const id = $(this).data('prod-id');
        // Set data ke form delete
        $('.produk_id').val(id);
        // Panggil modal delete
        $('#deleteProdukModal').modal('show');
    });
</script>
<?= $this->endSection(); ?>