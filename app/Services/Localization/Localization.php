<?php


namespace App\Services\Localization;


use App\Locale;

class Localization
{
    public static function locale() {
        $locale = request()->segment(1, '');
//        $locales = app(Locale::class)->getLocalesFromCache();
        $locales = Locale::where('status', '1')->pluck('name')->toArray();
        if ($locale && in_array($locale, $locales ) ) {
            return $locale;
        }
        return '';
    }
}
