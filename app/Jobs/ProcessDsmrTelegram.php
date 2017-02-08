<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
//        Do something
    }
}

// Fields: (source: file:///home/pascal/Downloads/20120403%20Dutch%20Smart%20Meter%20Requirements%20v4%200%204%20Final%20P1.pdf)
// [[
// KFM5KAIFA-METER
// 1-3:0.2.8(42)
// 0-0:1.0.0(160821180332S)         | Datetime format: YYMMDDhhmmssX
// 0-0:96.1.1(4530303235303030303333333837313135) | Equipment ID
// 1-0:1.8.1(001018.187*kWh)        | Totaal verbruik hoog
// 1-0:1.8.2(000939.225*kWh)        | Totaal verbruik laag
// 1-0:2.8.1(000205.280*kWh)        | Totaal opbrengst hoog
// 1-0:2.8.2(000448.215*kWh)        | Totaal opgrengst laag
// 0-0:96.14.0(0001)                | Hoog of laag tarief
// 1-0:1.7.0(00.000*kW)             | Huidig verbruik
// 1-0:2.7.0(00.386*kW)             | Huidig opbrengst
// 0-0:96.7.21(00009)
// 0-0:96.7.9(00007)
// 1-0:99.97.0(1)(0-0:96.7.19)(000101000001W)(2147483647*s)
// 1-0:32.32.0(00000)
// 1-0:32.36.0(00000)
// 0-0:96.13.1()
// 0-0:96.13.0()
// 1-0:31.7.0(001*A)
// 1-0:21.7.0(00.000*kW)
// 1-0:22.7.0(00.386*kW)
// 0-1:24.1.0(003)
// 0-1:96.1.0(4730303332353631323430373230303135)
// 0-1:24.2.1(160821180000S)(01226.942*m3) | Gas totaal
// !D3FB
// ]]