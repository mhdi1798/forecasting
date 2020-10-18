<?php

$analisa = get_analisa();

//echo '<pre>' . print_r($analisa, 1) . '</pre>';

foreach ($analisa as $key_jenis => $val_jenis) :

    $ftm = new FTM($val_jenis, $next_periode);
    //echo '<pre>' . print_r($ftm, 1) . '</pre>';
    $categories = array();
    $series = array();
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $JENIS[$key_jenis] ?></h3>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tahun (n)</th>
                        <th>Y</th>
                        <th>X</th>
                        <th>X*Y</th>
                        <th>X^2</th>
                        <th>Fx</th>
                        <th>e = F<sub>t</sub>-Y<sub>t</sub></th>
                        <th>|e|</th>
                        <th>e<sup>2</sup></th>
                        <th>e/Y<sub>t</sub></th>
                    </tr>
                </thead>
                <?php foreach ($val_jenis as $key => $val) :
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = $val * 1;
                    $series['prediksi']['data'][$key] = round($ftm->fx[$key], 2); ?>
                    <tr>
                        <td><?= date('M-Y', strtotime($key)) ?></td>
                        <td><?= number_format($val) ?></td>
                        <td><?= $ftm->x[$key] ?></td>
                        <td><?= number_format($ftm->xy[$key]) ?></td>
                        <td><?= number_format($ftm->x_kuadrat[$key]) ?></td>
                        <td><?= number_format($ftm->fx[$key]) ?></td>
                        <td><?= number_format($ftm->err[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_abs[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_square[$key], 2) ?></td>
                        <td><?= number_format($ftm->err_yt[$key], 2) ?></td>
                    </tr>
                <?php endforeach ?>
                <tfoot>
                    <tr>
                        <td>Total</td>
                        <td><?= number_format($ftm->z1) ?></td>
                        <td><?= $ftm->a2 ?></td>
                        <td><?= number_format($ftm->z2) ?></td>
                        <td><?= number_format($ftm->b2) ?></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="panel-body">
            Formula = <?= number_format($ftm->a) ?> + <?= number_format($ftm->b) ?>x<br />
            MSE = <?= number_format($ftm->errs['MSE'], 2) ?><br />
            RMSE = <?= number_format($ftm->errs['RMSE'], 2) ?><br />
            MAD = <?= number_format($ftm->errs['MAD'], 2) ?><br />
            MAPE = <?= round($ftm->errs['MAPE'] * 100, 2) ?>%<br />
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Tahun (n)</th>
                        <th>X</th>
                        <th>Fx</th>
                    </tr>
                </thead>
                <?php foreach ($ftm->next_fx as $key => $val) :
                    $categories[$key] = $key;
                    $series['aktual']['data'][$key] = null;
                    $series['prediksi']['data'][$key] = round($val, 2); ?>
                    <tr>
                        <td><?= date('M-Y', strtotime($key)) ?></td>
                        <td><?= $ftm->next_x[$key] ?></td>
                        <td><?= number_format($val) ?></td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
        <div class="panel-body">
            <script src="assets/js/highcharts.js"></script>
            <script src="assets/js/modules/exporting.js"></script>
            <script src="assets/js/modules/export-data.js"></script>
            <script src="assets/js/modules/accessibility.js"></script>

            <div id="container_<?= $key_jenis ?>"></div>
            <script>
                <?php
                $categories = array_values($categories);
                $series['aktual']['name'] = 'Aktual';
                $series['prediksi']['name'] = 'Prediksi';
                $series['aktual']['data'] = array_values($series['aktual']['data']);
                $series['prediksi']['data'] = array_values($series['prediksi']['data']);
                $series = array_values($series);
                ?>
                Highcharts.chart('container_<?= $key_jenis ?>', {
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: 'Grafik Data dan Hasil Prediksi ' + '<?= $JENIS[$key_jenis] ?>'
                    },
                    // subtitle: {
                    //     text: 'Source: WorldClimate.com'
                    // },
                    xAxis: {
                        categories: <?= json_encode($categories) ?>
                    },
                    yAxis: {
                        title: {
                            text: 'Total'
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: <?= json_encode($series) ?>
                });
            </script>
        </div>
    </div>
<?php endforeach ?>