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

    public static function getDateForPost(string $datetime, bool $short = true)
    {
        if (!$datetime) {
            return null;
        }

        self::setLocale();

        $data = ucwords((new Date($datetime))->format('j F Y | H:i'));

        if ($short) {
            $words = explode(' ', $data);

            return $words[0] . ' ' . substr($words[1], 0, 3) . ' ' . $words[2];
        }

        return $data;
    }

    private static function setLocale()
    {
        Date::setLocale('pt');
    }
}