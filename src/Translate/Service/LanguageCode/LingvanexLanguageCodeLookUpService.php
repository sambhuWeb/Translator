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
            case TranslatorLanguageCode::TELUGU:
                return LingvanexLanguageCode::TELUGU;
            case TranslatorLanguageCode::MALAYALAM:
                return LingvanexLanguageCode::MALAYALAM;
            case TranslatorLanguageCode::KANNADA:
                return LingvanexLanguageCode::KANNADA;
            case TranslatorLanguageCode::SINHALA:
                return LingvanexLanguageCode::SINHALA;
            case TranslatorLanguageCode::PUNJABI:
                return LingvanexLanguageCode::PUNJABI;
            case TranslatorLanguageCode::GUJARATI:
                return LingvanexLanguageCode::GUJARATI;
            case TranslatorLanguageCode::MARATHI:
                return LingvanexLanguageCode::MARATHI;
            case TranslatorLanguageCode::ORIYA:
                return LingvanexLanguageCode::ORIYA;
            case TranslatorLanguageCode::BANGLA:
                return LingvanexLanguageCode::BANGLA;
            case TranslatorLanguageCode::URDU:
                return LingvanexLanguageCode::URDU;
            case TranslatorLanguageCode::ARABIC:
                return LingvanexLanguageCode::ARABIC_UAE;
            case TranslatorLanguageCode::FARSI:
                return LingvanexLanguageCode::FARSI;
            case TranslatorLanguageCode::MALAY:
                return LingvanexLanguageCode::MALAY;
            case TranslatorLanguageCode::TAGALOG:
                return LingvanexLanguageCode::TAGALOG;
            case TranslatorLanguageCode::GREEK:
                return LingvanexLanguageCode::GREEK;
            case TranslatorLanguageCode::SPANISH:
                return LingvanexLanguageCode::SPANISH;
            case TranslatorLanguageCode::ITALIAN:
                return LingvanexLanguageCode::ITALIAN;
            case TranslatorLanguageCode::PORTUGUESE:
                return LingvanexLanguageCode::PORTUGUESE;
            case TranslatorLanguageCode::GERMAN:
                return LingvanexLanguageCode::GERMAN;
            case TranslatorLanguageCode::AMHARIC:
                return LingvanexLanguageCode::AMHARIC;
            case TranslatorLanguageCode::SWAHILI:
                return LingvanexLanguageCode::SWAHILI;
            case TranslatorLanguageCode::AFRIKAANS:
                return LingvanexLanguageCode::AFRIKAANS;
            default:
                // return same and rely on exception from lingvanex
                return $languageCode;
        }
    }
}
