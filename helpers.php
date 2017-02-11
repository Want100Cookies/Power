<?php

if (!function_exists('hex2string')) {
    /**
     * Convert readable hex-string to character string i.e. "41424344" => "ABCD"
     *
     * Source: https://github.com/micromys/Omnik/blob/master/inverter_class.php
     * @param $hex
     * @return string
     */
    function hex2str($hex)
    {
        $string = '';

        // process each pair of bytes
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            // pick 2 bytes, convert via hexdec to chr
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }

        return $string;
    }
}

if (!function_exists('str2dec')) {
    /**
     * convert string to decimal    i.e. string = 0x'0101' (=chr(1).chr(1)) => dec = 257
     *
     * Source: https://github.com/micromys/Omnik/blob/master/inverter_class.php
     * @param $string
     * @return int
     */
    function str2dec($string)
    {
        // reverse string 0x'121314'=> 0x'141312'
        $str = strrev($string);
        $dec = 0;

        // foreach byte calculate decimal value multiplied by power of 256^$i
        for ($i = 0; $i < strlen($string); $i++) {
            // take a byte, get ascii value, multiply by 256^(0,1,...n where n=length-1) and add to $dec
            $dec += ord(substr($str, $i, 1)) * pow(256, $i);
        }

        return $dec;
    }
}

if (!function_exists('getLong')) {
    /**
     * Convert 4 bytes to decimal
     *
     * @param string $string
     * @param int $start
     * @param int $divider
     * @return float
     */
    function getLong(string $string, int $start = 71, int $divider = 10)
    {
        $long = floatval(
            str2dec(
                substr(
                    $string,
                    $start,
                    4
                )
            )
        );

        return $long / $divider;
    }
}

if (!function_exists('getShort')) {
    /**
     * Convert to decimal 2 bytes
     *
     * @param string $string
     * @param int $start
     * @param int $divider
     * @return float
     */
    function getShort(string $string, int $start, int $divider)
    {
        $short = floatval(
            str2dec(
                substr(
                    $string,
                    $start,
                    2
                )
            )
        );

        // if 0xFFFF return 0 else value/divider
        return ($short == 65535) ? 0 : $short / $divider;
    }
}

if (!function_exists('getShortIterated')) {
    /**
     * @param string $string
     * @param int $start
     * @param int $divider
     * @param int $offset
     * @return array
     */
    function getShortIterated(string $string, int $start, int $divider, int $offset = 2)
    {
        $values = [];

        for ($i = 1; $i <= 3; $i++) {
            $short = getShort($string, $start + $offset * ($i - 1), $divider);
            $values[] = ($short == 65535) ? 0 : $short / $divider;
        }

        return $values;
    }
}
