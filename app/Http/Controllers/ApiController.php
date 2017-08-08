<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessDsmrTelegram;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function DsmrTelegramRaw(Request $request)
    {
        $this->validate($request, [
            'telegram' => 'required|string',
        ]);

        $job = (new ProcessDsmrTelegram($request->get('telegram')))
            ->onQueue('process-telegrams');

        dispatch($job);
    }
}
