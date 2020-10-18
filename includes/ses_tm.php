<?php

class FTM
{
    public $y;
    public $next_periode;
    public $x;
    public $xy;
    public $x_kuadrat;
    public $max_periode;

    public $err;
    public $err_abs;
    public $err_square;
    public $err_yt;

    function __construct($y, $next_periode)
    {
        $this->y = $y;
        $this->next_periode = $next_periode;
        $this->hitung();
    }

    function hitung()
    {
        $a = 0;
        foreach ($this->y as $key => $val) {
            $this->x[$key] = $a++;
        }

        foreach ($this->y as $key => $val) {
            $this->xy[$key] = $this->x[$key] * $val;
        }

        foreach ($this->x as $key => $val) {
            $this->x_kuadrat[$key] = $val * $val;
        }

        $this->z1 = array_sum($this->y);
        $this->z2 = array_sum($this->xy);
        $this->a1 = count($this->y);
        $this->a2 = array_sum($this->x);
        $this->b1 = array_sum($this->x);
        $this->b2 = array_sum($this->x_kuadrat);

        $this->b = ($this->a2 * $this->z1 - $this->a1 * $this->z2) / ($this->a2 * $this->b1 - $this->a1 * $this->b2);
        $this->a = ($this->b2 * $this->z1 - $this->b1 * $this->z2) / ($this->b2 * $this->a1 - $this->b1 * $this->a2);

        foreach ($this->x as $key => $val) {
            $this->fx[$key] = $this->a + $this->b * $val;
            $this->err[$key] = $this->fx[$key] - $this->y[$key];
            $this->err_abs[$key] = abs($this->err[$key]);
            $this->err_square[$key] = pow($this->err[$key], 2);
            $this->err_yt[$key] = $this->err_abs[$key] / $this->y[$key];
        }

        $pembagi = count($this->err);
        $this->errs = array(
            'MSE' => array_sum($this->err_square) / $pembagi,
            'RMSE' => sqrt(array_sum($this->err_square) / $pembagi),
            'MAD' => array_sum($this->err_abs) / $pembagi,
            'MAPE' => array_sum($this->err_yt) / $pembagi,
        );

        $this->max_periode = max(array_keys($this->y));
        $x = max($this->x);
        for ($a = 1; $a <= $this->next_periode; $a++) {
            $key = date('Y-m-d', strtotime("+$a month", strtotime($this->max_periode)));
            $x++;
            $this->next_x[$key] = $x;
            $this->next_fx[$key] = $this->a + $this->b * $x;
        }
    }
}

class SES
{
    public $yt;
    public $alpha_yt;
    public $next_periode;
    public $alpha;
    public $ft;
    public $et;
    public $x_kuadrat;
    public $max_periode;

    function __construct($yt, $next_periode, $alpha)
    {
        $this->yt = $yt;
        $this->next_periode = $next_periode;
        $this->alpha = $alpha;
        $this->hitung();
        $this->error();
    }

    function error()
    {
        $a = 1;
        foreach ($this->ft as $key => $val) {
            if ($a > $this->alpha) {
                $this->et[$key] = $this->ft[$key] - $this->yt[$key];
                $this->et_square[$key] = $this->et[$key] * $this->et[$key];
                $this->et_abs[$key] = abs($this->et[$key]);
                $this->et_yt[$key] = abs($this->et[$key] / $val);
            }
            $a++;
        }
        $this->error['MSE'] = array_sum($this->et_square) / count($this->et_square);
        $this->error['RMSE'] = sqrt($this->error['MSE']);
        $this->error['MAE'] = array_sum($this->et_abs) / count($this->et_abs);
        $this->error['MAPE'] = array_sum($this->et_yt) / count($this->et_yt) * 100;
        //echo ' <pre>' . print_r($this->error, 1) . '</pre>';
    }

    function hitung()
    {
        $prev = array();

        $no = 1;
        $temp_yt = 0;
        $temp_alpha_yt = 0;
        $temp_ft = 0;

        foreach ($this->yt as $key => $val) {
            if ($no > 1)
                $this->alpha_yt[$key] = $this->alpha * $this->yt[$key];

            if ($no > 1)
                $this->ft[$key] = $temp_yt;
            if ($no > 2) {
                $this->ft[$key] = $temp_alpha_yt + (1 - $this->alpha) * $temp_ft;
            }

            $temp_alpha_yt = $this->alpha_yt[$key];
            $temp_yt = $this->yt[$key];
            $temp_ft = $this->ft[$key];
            $no++;
        }
        $this->max_periode = max(array_keys($this->yt));
        for ($a = 1; $a <= $this->next_periode; $a++) {
            $key = date('Y-m-d', strtotime("+$a month", strtotime($this->max_periode)));
            $this->next_ft[$key] = $temp_alpha_yt + (1 - $this->alpha) * $temp_ft;
            //$temp_alpha_yt = $temp_ft * $this->alpha; 
            $temp_ft = $this->next_ft[$key];
        }
        //echo ' <pre>' . print_r($this->next_ft, 1) . '</pre>';
    }
}
