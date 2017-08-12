<?php

namespace App\Http\Controllers;

use App\Models\PVTelegram;

class PVController extends Controller
{
    public function current()
    {
        return PVTelegram::orderBy('created_at', 'DESC')->first();
    }
}
