<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;

class Localization
{
    const EN = 1;
    const PTBR = 2;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = Settings::first();

        $this->setTimezone($settings);

        $language = $this->getLanguage($settings);

        \App::setLocale($language);

        return $next($request);
    }

    private function getLanguage(Settings $settings): string
    {
        if ($settings->language_id === self::EN) {
            return 'en';
        }

        if ($settings->language_id === self::PTBR) {
            return 'ptbr';
        }

        return 'en';
    }

    private function setTimezone(Settings $settings): void
    {
        if ($settings->language_id === self::EN) {
            setlocale(LC_TIME, 'en', 'en.utf-8', 'en.utf-8', 'english');
            date_default_timezone_set('America/Los_Angeles');
        }

        if ($settings->language_id === self::PTBR) {
            setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
            date_default_timezone_set('America/Sao_Paulo');
        }
    }
}
