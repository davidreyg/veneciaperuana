<?php

namespace App\Configuration;

use Carbon\Carbon;

class DateFormatter
{
    protected static $dateFormats = [
        [
            "carbon_format" => "Y M d",
            "moment_format" => "YYYY MMM DD"
        ],
        [
            "carbon_format" => "d M Y",
            "moment_format" => "DD MMM YYYY"
        ],
        [
            "carbon_format" => "d/m/Y",
            "moment_format" => "DD/MM/YYYY"
        ],
        [
            "carbon_format" => "d.m.Y",
            "moment_format" => "DD.MM.YYYY"
        ],
        [
            "carbon_format" => "d-m-Y",
            "moment_format" => "DD-MM-YYYY"
        ],
        [
            "carbon_format" => "m/d/Y",
            "moment_format" => "MM/DD/YYYY"
        ],
        [
            "carbon_format" => "Y/m/d",
            "moment_format" => " YYYY/MM/DD"
        ],
        [
            "carbon_format" => "Y-m-d",
            "moment_format" => "YYYY-MM-DD"
        ],
    ];

    public static function getListofDateFormats()
    {
        $dateFormatList = [];

        foreach (static::$dateFormats as $dateFormat) {
            $dateFormatList[] = array(
                "display_date" => Carbon::now()->format($dateFormat['carbon_format']),
                "carbon_format_value" => $dateFormat['carbon_format'],
                "moment_format_value" => $dateFormat['moment_format']
            );
        }

        return $dateFormatList;
    }
}
