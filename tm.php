<div class="page-header">
    <h1>Perhitungan Trend Moment</h1>
</div>
<?php
$success = false;
if ($_POST) {
    $next_periode = $_POST['next_periode'];
    if ($next_periode == '') {
        print_msg('Isikan periode');
    } elseif ($next_periode <= 1) {
        print_msg('Masukkan periode minimal ' . 1);
    } else {
        $success = true;
    }
}
?>
<form method="post">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Masukkan periode</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Periode <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="next_periode" value="<?= set_value('next_periode', 3) ?>" />
                    </div>
                    <button class="btn btn-primary"><span class="glyphicon glyphicon-signal"></span> Hitung</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
$c = $db->get_results("SELECT * FROM tb_relasi WHERE nilai < 0");
if (!$PERIODE || !$JENIS) :
    echo "Tampaknya anda belum mengatur periode dan jenis. Silahkan tambahkan minimal 3 periode dan 3 jenis.";
elseif ($c) :
    echo "Tampaknya anda belum mengatur nilai periode. Silahkan atur pada menu <strong>Nilai Periode</strong>.";
elseif ($success) :
    include 'tm_hasil.php';
    $_SESSION['post'] = $_POST;
endif ?>