<?php

namespace Translator\Translate\Service\LanguageCode;

class LingvanexLanguageCodeLookUpService implements LanguageCodeLookUpServiceInterface
{
    public static function fetch(string $languageCode): string
    {
        switch ($languageCode) {
            case 'el':
            case 'el_GR':
                return 'el_GR';
            default:
                return 'throw exception';
        }
    }
}
