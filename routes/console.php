<?php


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('pv:request', function () {
    $job = (new \App\Jobs\ProcessPVTelegram())
        ->onQueue('process-telegrams');
    dispatch($job);

    $this->info('ProcessPVTelegram job send to queue "process-telegrams"');
})->describe('Send job to queue that request new PV information from the inverter');
