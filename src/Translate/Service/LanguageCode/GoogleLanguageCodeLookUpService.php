<?php

namespace Translator\Translate\Service\LanguageCode;

class GoogleLanguageCodeLookUpService implements LanguageCodeLookUpServiceInterface
{
    public static function fetch(string $languageCode): string
    {
        switch ($languageCode) {
            case 'el':
                return 'el';
            default:
                return 'throw exception';
        }
    }
}
