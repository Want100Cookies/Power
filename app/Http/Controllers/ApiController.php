<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDsmrTelegram;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function DsmrTelegramRaw(Request $request)
    {
        $this->validate($request, [
            'telegram' => 'required|string'
        ]);

        $job = (new ProcessDsmrTelegram($request->get('telegram')))
            ->onQueue('process-telegrams');

        dispatch($job);
    }
}
