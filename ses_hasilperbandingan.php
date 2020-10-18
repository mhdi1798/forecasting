<?php
$analisa = get_analisa();

//echo '<pre>' . print_r($analisa, 1) . '</pre>';

foreach ($analisa as $key_jenis => $val_jenis) :

    $ses = new SES($val_jenis, $next_periode, $alpha);
    //echo '<pre>' . print_r($ses, 1) . '</pre>';
    $categories = array();
    $series = array();
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><a data-toggle="collapse" href="#c_<?= $key_jenis ?>"><?= $JENIS[$key_jenis] ?></a></h3>
        </div>
        <div class="table-responsive collapse in" id="c_<?= $key_jenis ?>">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode (t)</th>
                        <th>Y<sub>t</sub></th>
                        <th>&alpha;</th>
                        <th>1-&alpha;</th>
                        <th>&alpha;Y<sub>t</sub></th>
                        <th>F<sub>t</sub></th>
                        <th>e<sub>t</sub></th>
                        <th>e<sub>t</sub><sup>2</sup></th>
                        <th>|e<sub>t</sub>|</th>
                        <th>|e<sub>t</sub> / y<sub>t</sub>|</th>
                    </tr>
                </thead>
                <?php foreach ($val_jenis as $key => $val) :
                    $categories[$key] =  date('M-Y', strtotime($key));
                    $series['aktual']['data'][$key] = $val * 1;
                    $series['prediksi']['data'][$key] = round($ses->ft[$key], 3); ?>
                    <tr>
                        <td><?= date('M-Y', strtotime($key)) ?></td>
                        <td><?= number_format($val) ?></td>
                        <td><?= $alpha ?></td>
                        <td><?= 1 - $alpha ?></td>
                        <td><?= number_format($ses->alpha_yt[$key], 3) ?></td>
                        <td><?= number_format($ses->ft[$key], 3) ?></td>
                        <td><?= number_format($ses->et[$key], 3) ?></td>
                        <td><?= number_format($ses->et_square[$key], 3) ?></td>
                        <td><?= number_format($ses->et_abs[$key], 3) ?></td>
                        <td><?= number_format($ses->et_yt[$key], 3) ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="7" class="text-right">MSE (Mean Squared Error)</td>
                    <td><?= number_format($ses->error['MSE'], 3) ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">RMSE (Root Mean Squared Error)</td>
                    <td><?= number_format($ses->error['RMSE'], 3) ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">MAE (Mean Absolute Error)</td>
                    <td>&nbsp;</td>
                    <td><?= number_format($ses->error['MAE'], 3) ?></td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">MAPE (Mean Absolute Percentage Error)</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><?= number_format($ses->error['MAPE'], 3) ?> % </td>
                </tr>
            </table>
        </div>
        <div class="panel-body">
            Hasil Prediksi:
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Periode (n)</th>
                        <th>F<sub>t</sub></th>
                    </tr>
                </thead>
                <?php foreach ($ses->next_ft as $key => $val) :
                    $categories[$key] =  date('M-Y', strtotime($key));
                    $series['aktual']['data'][$key] = null;
                    $series['prediksi']['data'][$key] = round($val, 3); ?>
                    <tr>
                        <td><?= date('M-Y', strtotime($key)) ?></td>
                        <td><?= number_format($val, 3) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
<?php endforeach ?>