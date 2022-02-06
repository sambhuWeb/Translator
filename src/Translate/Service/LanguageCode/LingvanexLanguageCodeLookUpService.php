<?php

namespace Translator\Translate\Service\LanguageCode;

use Translator\Translate\Constant\LingvanexLanguageCode;
use Translator\Translate\Constant\TranslatorLanguageCode;

class LingvanexLanguageCodeLookUpService implements LanguageCodeLookUpServiceInterface
{
    public static function fetch(string $languageCode): string
    {
        switch ($languageCode) {
            case TranslatorLanguageCode::ENGLISH:
                return LingvanexLanguageCode::ENGLISH;
            case TranslatorLanguageCode::NEPALI:
                return LingvanexLanguageCode::NEPALI;
            case TranslatorLanguageCode::HINDI:
                return LingvanexLanguageCode::HINDI;
            case TranslatorLanguageCode::TAMIL:
                return LingvanexLanguageCode::TAMIL;
            case TranslatorLanguageCode::MALAYALAM:
                return LingvanexLanguageCode::MALAYALAM;
            case TranslatorLanguageCode::KANNADA:
                return LingvanexLanguageCode::KANNADA;
            case TranslatorLanguageCode::SINHALA:
                return LingvanexLanguageCode::SINHALA;
            case TranslatorLanguageCode::BANGLA:
                return LingvanexLanguageCode::BANGLA;
            case TranslatorLanguageCode::URDU:
                return LingvanexLanguageCode::URDU;
            case TranslatorLanguageCode::ARABIC:
                return LingvanexLanguageCode::ARABIC_UAE;
            case TranslatorLanguageCode::MALAY:
                return LingvanexLanguageCode::MALAY;
            case TranslatorLanguageCode::TAGALOG:
                return LingvanexLanguageCode::TAGALOG;
            case TranslatorLanguageCode::GREEK:
                return LingvanexLanguageCode::GREEK;
            default:
                // return same and rely on exception from lingvanex
                return $languageCode;
        }
    }
}
