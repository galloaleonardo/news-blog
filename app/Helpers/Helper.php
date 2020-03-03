<?php


namespace App\Helpers;


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
}