<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/pengeluaran" class="btn btn-info"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Impor Data</h6>
            </div>
            <div class="card-body mx-2">
                <form action="/pengeluaran/upload" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="file_pengeluaran" class="col-sm-3 col-form-label">Upload File <sup class="text-danger">(*)</sup></label>
                        <div class="col-sm-9">
                            <input type="file" name="file_pengeluaran" id="file_pengeluaran" class="form-control custom-file-input <?= ($validation->hasError('file_pengeluaran')) ? 'is-invalid' : ''; ?>" onchange="upload_pengeluaran()">
                            <div class="invalid-feedback"><?= $validation->getError('file_pengeluaran'); ?></div>
                            <label class="custom-file-label file-pengeluaran" for="file_pengeluaran">Pilih File...</label>
                        </div>
                    </div>
                    <small><sup class="text-danger">(*)</sup> File yang diperbolehkan hanya Excel (.xls / .xlsx)</small>
                    <div class="form-group row mt-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script type="text/javascript">
    function upload_pengeluaran() {
        const import_pengeluaran = document.querySelector('#file_pengeluaran');
        const label_import_pengeluaran = document.querySelector('.file-pengeluaran');

        label_import_pengeluaran.textContent = import_pengeluaran.files[0].name;
        const file_import_pengeluaran = new FileReader();
        file_import_pengeluaran.readAsDataURL(import_pengeluaran.files[0]);
    }
</script>
<?= $this->endSection(); ?>