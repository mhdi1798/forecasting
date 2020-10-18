<div class="page-header">
    <h1>Tambah Periode</h1>
</div>
<form method="post">
    <div class="row">
        <div class="col-sm-6">
            <?php if ($_POST) include 'aksi.php' ?>
            <div class="form-group">
                <label>Kode Periode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode_periode" value="<?= kode_oto('kode_periode', 'tb_periode', 'P', 2) ?>" />
            </div>
            <div class="form-group">
                <label>Tanggal <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal" value="<?= set_value('tanggal', date('Y-m-d')) ?>" />
            </div>
            <?php
            foreach ($JENIS as $key => $val) : ?>
                <div class="form-group">
                    <label><?= $val ?></label>
                    <input class="form-control" type="number" name="nilai[<?= $key ?>]" value="<?= $_POST['nilai'][$key] ?>" />
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
        <a class="btn btn-danger" href="?m=periode"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
    </div>
</form>