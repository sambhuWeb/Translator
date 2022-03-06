<?php

namespace Translator\Translate\Service\LanguageCode;

use InvalidArgumentException;
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
                throw new InvalidArgumentException(
                    sprintf("%s translator type is not valid.", $translator)
                );
        }
    }
}
