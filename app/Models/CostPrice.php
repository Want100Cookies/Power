<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostPrice extends Model
{
    protected $fillable = [
        'type',
        'price',
    ];
}
