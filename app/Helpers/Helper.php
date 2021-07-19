<?php


namespace App\Helpers;

use App\Models\GoogleAds;
use App\Models\GoogleAnalytics;
use App\Models\Settings;
use Carbon\Carbon;
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

    public static function getRandomImageName()
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

    public static function getCompanyName()
    {
        $settings = Settings::first();

        return $settings->company_name ?? 'Larazine';
    }

    public static function useLogoByDefault(): bool
    {
        $settings = Settings::first();

        return (bool)$settings->use_logo_by_default;
    }

    public static function getCompetencyDateLanguage(Carbon $date)
    {
        if (\App::getLocale() === 'en') {
            return $date->format('Y-m');
        }

        if (\App::getLocale() === 'ptbr') {
            return $date->format('m/Y');
        }

        return $date->format('Y-m');
    }

    public static function getGoogleAdsScript()
    {
        $googleAds = GoogleAds::first();

        if (!(bool)$googleAds->active || !$googleAds->script) {
            return ' ';
        }

        return $googleAds->script;
    }

    public static function getGoogleAnalyticsScript()
    {
        $googleAnalytics = GoogleAnalytics::first();

        if (!(bool)$googleAnalytics->active || !$googleAnalytics->script) {
            return ' ';
        }

        return $googleAnalytics->script;
    }
}
