<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log; // Add this line

if (!function_exists('auto_translate')) {
    function auto_translate($text) {
        // Return originele tekst als het Nederlands is of auto_translate uit staat
        if (app()->getLocale() === 'nl' || !config('app.auto_translate', false)) {
            return $text;
        }

        try {
            // Cache sleutel gebaseerd op tekstinhoud
            $cacheKey = 'ar_translation_'.md5($text);

            return Cache::remember($cacheKey, now()->addMonth(), function() use ($text) {
                $translator = new \Stichoza\GoogleTranslate\GoogleTranslate();
                return $translator->setSource('nl')
                                ->setTarget('ar')
                                ->translate($text);
            });
        } catch (\Exception $e) {
            // Log de fout en retourneer originele tekst
            Log::error("Vertaling mislukt voor tekst: {$text}", ['error' => $e->getMessage()]);
            return $text;
        }
    }
}
