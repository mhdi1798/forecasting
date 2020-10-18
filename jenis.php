<div class="page-header">
    <h1>Jenis</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="jenis" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?= $_GET['q'] ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=jenis_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_jenis WHERE nama_jenis LIKE '%$q%' ORDER BY kode_jenis");
        $no = 0;
        foreach ($rows as $row) : ?>
            <tr>
                <td><?= $row->kode_jenis ?></td>
                <td><?= $row->nama_jenis ?></td>
                <td>
                    <a class="btn btn-xs btn-warning" href="?m=jenis_ubah&ID=<?= $row->kode_jenis ?>"><span class="glyphicon glyphicon-edit"></span></a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=jenis_hapus&ID=<?= $row->kode_jenis ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>