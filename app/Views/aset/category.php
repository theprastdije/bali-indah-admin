<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($validation->getErrors()) : ?>
                    <div class="alert alert-danger pb-0">
                        <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('asetcat')) : ?>
                    <div class="alert alert-success"><i class="fas fa-fw fa-check-circle"></i> <?= session()->getFlashdata('asetcat'); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-12">
        <a href="/aset" class="btn btn-info mb-3 mr-2"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <a href="/aset/addcategory" class="btn btn-info mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Data Baru</a>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Kode Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php if ($kategori) : ?>
                                <?php foreach ($kategori as $aset_cat) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $aset_cat['nama_kategori_aset']; ?></td>
                                        <td>(<?= $aset_cat['kode_akun']; ?>) <?= $aset_cat['nama_akun']; ?></td>
                                        <!-- <td><= $aset_cat['persen_penyusutan']; ?></td> -->
                                        <td>
                                            <a href="/aset/detailcategory/<?= $aset_cat['id']; ?>" class="btn btn-sm btn-info"><i class="fas fa-fw fa-eye"></i> Detail</a>
                                            <a href="/aset/editcategory/<?= $aset_cat['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger aset-cat-delete" data-asetcat-id="<?= $aset_cat['id']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteAsetCatModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAsetCatModalLabel">Hapus Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/aset/deletecategory" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kategori ini? Kategori yang sudah dihapus tidak dapat dikembalikan!</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="kategori_aset_id" class="kategoriAsetID">
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
    $(document).ready(function() {
        // Delete
        $('.aset-cat-delete').on('click', function() {
            // Ambil data btn delete
            const id = $(this).data('asetcat-id');
            // Set data ke form delete
            $('.kategoriAsetID').val(id);
            // Panggil modal delete
            $('#deleteAsetCatModal').modal('show');
        });
    });
</script>
<?= $this->endSection(); ?>