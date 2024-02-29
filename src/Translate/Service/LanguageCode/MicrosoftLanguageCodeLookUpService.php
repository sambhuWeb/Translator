<?php

namespace Translator\Translate\Service\LanguageCode;

class MicrosoftLanguageCodeLookUpService implements LanguageCodeLookUpServiceInterface
{
    /**
     * @param string $languageCode
     * @return string
     */
    public static function fetch(string $languageCode): string
    {
        // Quite often microsoft language code is used as a default two-digit code so
        // pretty safe to return same language code that has been passed
        return $languageCode;
    }
}
