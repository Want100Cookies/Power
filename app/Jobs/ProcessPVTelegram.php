<?php

namespace App\Jobs;

use App\Models\PVTelegram;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPVTelegram implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parsed = new PVTelegram();

        $raw = $this->receiveTelegram();

        $parsed->inverter_id = substr($raw, 15, 15);

        $parsed->temperature = getShort($raw, 31, 10);

        list(
            $parsed->vpv1,
            $parsed->vpv2,
            $parsed->vpv3
            ) = getShortIterated($raw, 33, 10);

        list(
            $parsed->ipv1,
            $parsed->ipv2,
            $parsed->ipv3
            ) = getShortIterated($raw, 39, 10);

        list(
            $parsed->iac1,
            $parsed->iac2,
            $parsed->iac3
            ) = getShortIterated($raw, 45, 10); // Ampere

        list(
            $parsed->vac1,
            $parsed->vac2,
            $parsed->vac3
            ) = getShortIterated($raw, 51, 10); // Volt Ampere

        list(
            $parsed->fac1,
            $parsed->fac2,
            $parsed->fac3
            ) = getShortIterated($raw, 57, 100, 4); // What is this?

        list(
            $parsed->pac1,
            $parsed->pac2,
            $parsed->pac3
            ) = getShortIterated($raw, 59, 1, 4); // Current power

        $parsed->total_day = getShort($raw, 69, 100); // Today in w
        $parsed->total = getLong($raw, 71, 10); // Total in Kw
        $parsed->hours_since_reset = getLong($raw, 75, 1);

        $parsed->save();
    }

    /**
     * The identification string is build from several parts.
     *    a. The first part is a fixed 4 char string: 0x68024030;
     *    b. the second part is the reversed hex notation of the s/n twice;
     *    c. then again a fixed string of two chars : 0x0100;
     *    d. a checksum of the double s/n with an offset;
     *    e. and finally a fixed ending char : 0x16;
     *
     * @return string
     */
    protected function getInverterChecksum()
    {
        $hex = dechex(config('inverter.serial'));
        $cs = 115;
        $tmpStr = '';

        // in reverse order of serial; 11223344 => 44332211 and calculate checksum
        for ($i = strlen($hex); $i > 0; $i -= 2) {
            // create reversed string byte for byte
            $tmpStr .= substr($hex, $i - 2, 2);
            // multiply by 2 because of rule b and d
            $cs += 2 * ord(
                    hex2str(
                        substr(
                            $hex,
                            $i - 2,
                            2
                        )
                    )
                );
        }

        // convert checksum and take last byte
        $checksum = hex2str(
            substr(
                dechex($cs),
                -2
            )
        );

        // now glue all parts together
        return "\x68\x02\x40\x30" .
            hex2str($tmpStr . $tmpStr) .
            "\x01\x00" .
            $checksum .
            "\x16";
    }

    /**
     * Receive telegram using tcp socket
     *
     * @return string
     * @throws \Exception
     */
    public function receiveTelegram()
    {
        $sock = @stream_socket_client(
            'tcp://' . config('inverter.ip') . ':' . config('inverter.port'),
            $errorCode,
            $errorStr,
            10
        );

        if ($sock === false) {
            throw new \Exception($errorStr, $errorCode); // Todo: throw custom exception and save to DB for later use
        }

        $checksum = $this->getInverterChecksum();

        $sentBytes = fwrite($sock, $checksum, strlen($checksum));

        if ($sentBytes === false) {
            throw new \Exception('Error sending checksum to inverter');
        }

        $buffer = @fread($sock, 128);
        fclose($sock);

        if ($buffer === false || strlen($buffer) <= 90) {
            throw new \Exception('Could not read 99 bytes from inverter');
        }

        return $buffer;
    }
}