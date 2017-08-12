<?php

namespace App\Http\Controllers;

use App\Models\PVTelegram;
use Illuminate\Http\Request;

class PVController extends Controller
{
    public function current()
    {
        return PVTelegram::orderBy('created_at', 'DESC')->first();
    }
}
