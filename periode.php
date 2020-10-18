<div class="page-header">
    <h1>Periode</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="periode" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=periode_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <?php foreach ($JENIS as $key => $val) : ?>
                        <th><?= $val ?></th>
                    <?php endforeach ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_periode WHERE tanggal LIKE '%$q%' ORDER BY kode_periode");
            $no = 0;

            $analisa = get_data();

            //echo '<pre>' . print_r($analisa, 1) . '</pre>';
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row->kode_periode ?></td>
                    <td><?= $row->tanggal ?></td>
                    <?php foreach ($analisa[$PERIODE[$row->kode_periode]] as $k => $v) : ?>
                        <td><?= $v ?></td>
                    <?php endforeach ?>
                    <td>
                        <a class="btn btn-xs btn-warning" href="?m=periode_ubah&ID=<?= $row->kode_periode ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=periode_hapus&ID=<?= $row->kode_periode ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>