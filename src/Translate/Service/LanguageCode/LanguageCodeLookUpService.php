<?php

namespace Translator\Translate\Service\LanguageCode;

use Translator\Translate\Constant\Translator;

class LanguageCodeLookUpService
{
    public static function fetch(string $languageCode, string $translator): string
    {
        switch($translator) {
            case Translator::LINGVANEX:
                return LingvanexLanguageCodeLookUpService::fetch($languageCode);
            case Translator::GOOGLE:
                return GoogleLanguageCodeLookUpService::fetch($languageCode);
            default:
                return 'some exception';
        }
    }
}
