<?php

namespace Translator\Translate\Service\LanguageCode;

class GoogleLanguageCodeLookUpService implements LanguageCodeLookUpServiceInterface
{
    /**
     * @param string $languageCode
     * @return string
     */
    public static function fetch(string $languageCode): string
    {
        switch ($languageCode) {
            case 'el':
                return 'el';
            case 'ar':
                return 'ar';
            default:
                // Quite often google language code is used as a default two-digit code so
                // pretty safe to return same language code that has been passed
                return $languageCode;
        }
    }
}
