<?php


namespace App\Helpers;

use Jenssegers\Date\Date;

class Helper
{
    public static function checkPath(Array $paths)
    {
        foreach ($paths as $path) {
            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0777, true, true);
            }
        }
    }

    public static function getRandomNameImage()
    {
        return rand() . date('Y-m-d');
    }

    public static function getWrittenDateLanguage(string $datetime, bool $short = true)
    {
        if (!$datetime) {
            return null;
        }

        if ($short) {
            return strtolower(strftime('%d %b %y', strtotime($datetime)));
        }

        return strtolower(strftime('%A, %d %B %Y', strtotime($datetime)));
    }

    public static function getDateFormatLanguage($date)
    {
        if (\App::getLocale() === 'en') {
            return date_format($date, 'Y-m-d');
        }

        if (\App::getLocale() === 'ptbr') {
            return date_format($date, 'd/m/Y');
        }

        return date_format($date, 'Y-m-d');
    }

    private static function setDateLocale(): bool
    {
        return Date::setLocale(\App::getLocale());
    }
}
