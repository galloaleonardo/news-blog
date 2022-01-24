<?php


namespace App\Helpers;

use App\Models\GoogleAds;
use App\Models\GoogleAnalytics;
use App\Models\Settings;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Http;

class Helper
{

    const ADMIN_USER = 1;
    const EN = 'en';
    const PTBR = 'ptbr';
    const URL_EMBED_TWEET = 'https://publish.twitter.com/oembed?url=';

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

    public static function getDateFormatLanguage($date)
    {
        $locale = \App::getLocale();

        if ($locale === self::EN) {
            return date_format($date, 'Y-m-d');
        }

        if ($locale === self::PTBR) {
            return date_format($date, 'd/m/Y');
        }

        return date_format($date, 'Y-m-d');
    }

    public static function hasCompanyName()
    {
        $settings = Settings::first();

        return $settings->company_name ? true : false;
    }

    public static function useLogoByDefault(): bool
    {
        $settings = Settings::first();

        return (bool)$settings->use_logo_by_default;
    }

    public static function getCompanyName()
    {
        $settings = Settings::first();

        return $settings->company_name ?? 'Larazine';
    }

    public static function faviconExists()
    {
        return file_exists(public_path('images/ico/icon_tab.ico'));
    }

    public static function getCompetencyDateLanguage(Carbon $date)
    {
        $locale = \App::getLocale();

        if ($locale === self::EN) {
            return $date->format('Y-m');
        }

        if ($locale === self::PTBR) {
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

    public static function getYoutubeLink(string $link)
    {
        $shortLink = substr($link, strpos($link, "watch?v=") + 8, 11);

        $embeddedLink = 'https://www.youtube.com/embed/' . $shortLink;

        return $embeddedLink;
    }

    public static function userIsAdmin()
    {
        return \Auth::user()->id === self::ADMIN_USER;
    }

    public static function deleteImage($imagePath)
    {
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

    public static function getEmbededTweet(string $link)
    {

        try {
            $response = Http::get(self::URL_EMBED_TWEET . $link);

            if ($response->status() === 200) {
                $content = $response->json();

                if (isset($content['html']) && $content['html']) {
                    return $content['html'];
                }
            }
        } catch (\Throwable $th) {
            return "<div class='fail_to_load_tweet'></div>";
        }
        
        return "<div class='fail_to_load_tweet'></div>";
    }
}
