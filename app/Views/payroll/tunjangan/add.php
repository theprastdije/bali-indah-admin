<?= $this->extend('layout/main'); ?>

<?= $this->section('konten'); ?>
<div class="row">
    <div class="col-lg-6">
        <a href="/tunjangan" class="btn btn-primary"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        <?php if ($validation->getErrors()) : ?>
            <div class="alert alert-danger pb-0 mt-2">
                <i class="fas fa-fw fa-times-circle"></i> Mohon perhatikan <strong>ERROR</strong> berikut:<?= $validation->listErrors(); ?>
            </div>
        <?php endif; ?>
        <div class="card my-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Gaji Staf</h6>
            </div>
            <div class="card-body">
                <form action="/tunjangan/insert" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group row">
                        <label for="nama_staf" class="col-sm-3 col-form-label">Nama Staf</label>
                        <div class="col-sm-9">
                            <select name="nama_staf" id="nama_staf" class="form-control custom-select" value="<?= old('nama_staf'); ?>">
                                <option>Pilih Staf ...</option>
                                <?php foreach ($staf as $staf) : ?>
                                    <option value="<?= $staf['id']; ?>" <?= ($staf['id'] == old('nama_staf') ? 'selected' : ''); ?>><?= $staf['nama_staf']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_tunjangan" class="col-sm-3 col-form-label">Jenis Tunjangan</label>
                        <div class="col-sm-9">
                            <select name="jenis_tunjangan" id="jenis_tunjangan" class="form-control custom-select">
                                <option>Pilih Jenis Tunjangan ...</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>

<?= $this->endSection(); ?>