<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PVTelegram extends Model
{
    protected $table = 'pv_telegrams';

    protected $casts = [
        'temperature' => 'float',
        'vpv1' => 'float',
        'vpv2' => 'float',
        'vpv3' => 'float',
        'ipv1' => 'float',
        'ipv2' => 'float',
        'ipv3' => 'float',
        'iac1' => 'float',
        'iac2' => 'float',
        'iac3' => 'float',
        'vac1' => 'float',
        'vac2' => 'float',
        'vac3' => 'float',
        'fac1' => 'float',
        'fac2' => 'float',
        'fac3' => 'float',
        'pac1' => 'float',
        'pac2' => 'float',
        'pac3' => 'float',
        'total_day' => 'float',
        'total' => 'float',
        'hours_since_reset' => 'float',
    ];
}
