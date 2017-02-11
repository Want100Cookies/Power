<?php

namespace App\Jobs;

use App\Models\DsmrTelegram;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Spatie\Regex\Regex;

class ProcessDsmrTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private $telegram;

    /**
     * Create a new job instance.
     *
     * @param string $telegram
     */
    public function __construct(string $telegram)
    {
        $this->telegram = $telegram;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parsed = new DsmrTelegram();


        $parsed->send_at = $this->parseTST('0-0:1\.0\.0', $this->telegram);

        $parsed->meter_id = Regex::match(
            '/0-0:96\.1\.1\((\d*)\)/mi',
            $this->telegram
        )->group(1);

        $parsed->total_usage_high_tariff = Regex::match(
            '/1-0:1\.8\.1\((\d{6}\.\d{3})\*kWh\)/mi',
            $this->telegram
        )->group(1);

        $parsed->total_usage_low_tariff = Regex::match(
            '/1-0:1\.8\.2\((\d{6}\.\d{3})\*kWh\)/mi',
            $this->telegram
        )->group(1);

        $parsed->total_yield_high_tariff = Regex::match(
            '/1-0:2\.8\.1\((\d{6}\.\d{3})\*kWh\)/mi',
            $this->telegram
        )->group(1);

        $parsed->total_yield_low_tariff = Regex::match(
            '/1-0:2\.8\.2\((\d{6}\.\d{3})\*kWh\)/mi',
            $this->telegram
        )->group(1);

        $parsed->current_tariff = Regex::match(
            '/0-0:96\.14\.0\(000([01])\)/mi',
            $this->telegram
        )->group(1);

        $parsed->current_usage = Regex::match(
            '/1-0:1\.7\.0\((\d{2}\.\d{3})\*kW\)/mi',
            $this->telegram
        )->group(1);

        $parsed->current_yield = Regex::match(
            '/1-0:2\.7\.0\((\d{2}\.\d{3})\*kW\)/mi',
            $this->telegram
        )->group(1);

        $parsed->gas_send_at = $this->parseTST('0-1:24\.2\.1', $this->telegram);

        $parsed->gas_total = Regex::match(
            '/0-1:24\.2\.1\(\d{12}[SW]\)\((\d{5}\.\d{3})\*m3\)/mi',
            $this->telegram
        )->group(1);

        $parsed->save();
    }

    /**
     * Parse TST types from telegram
     *
     * @param string $regex
     * @param string $telegram
     * @return Carbon
     */
    protected function parseTST(string $regex, string $telegram)
    {
        $tst = Regex::match(
            '/' . $regex . '\((\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})([SW])\)/mi',
            $telegram
        );

        return Carbon::create(
            substr(Carbon::now()->year, 0, 2) . $tst->group(1), // Because the group states '16' instead of '2016'
            $tst->group(2),
            $tst->group(3),
            $tst->group(4),
            $tst->group(5),
            $tst->group(6)
        );
    }
}