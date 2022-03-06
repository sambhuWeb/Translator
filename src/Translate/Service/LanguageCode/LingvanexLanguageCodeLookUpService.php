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
            case TranslatorLanguageCode::SINDHI:
                return LingvanexLanguageCode::SINDHI;
            case TranslatorLanguageCode::PASHTO:
                return LingvanexLanguageCode::PASHTO;
            case TranslatorLanguageCode::KURDISH:
                return LingvanexLanguageCode::KURDISH;
            case TranslatorLanguageCode::URDU:
                return LingvanexLanguageCode::URDU;
            case TranslatorLanguageCode::ARABIC:
                return LingvanexLanguageCode::ARABIC_UAE;
            case TranslatorLanguageCode::FARSI:
                return LingvanexLanguageCode::FARSI;
            case TranslatorLanguageCode::HEBREW:
                return LingvanexLanguageCode::HEBREW;
            case TranslatorLanguageCode::THAI:
                return LingvanexLanguageCode::THAI;
            case TranslatorLanguageCode::MYANMAR:
                return LingvanexLanguageCode::MYANMAR;
            case TranslatorLanguageCode::MALAY:
                return LingvanexLanguageCode::MALAY;
            case TranslatorLanguageCode::VIETNAMESE:
                return LingvanexLanguageCode::VIETNAMESE;
            case TranslatorLanguageCode::LAO:
                return LingvanexLanguageCode::LAO;
            case TranslatorLanguageCode::INDONESIAN:
                return LingvanexLanguageCode::INDONESIAN;
            case TranslatorLanguageCode::JAVANESE:
                return LingvanexLanguageCode::JAVANESE;
            case TranslatorLanguageCode::KHMER:
                return LingvanexLanguageCode::KHMER;
            case TranslatorLanguageCode::TAGALOG:
                return LingvanexLanguageCode::TAGALOG;
            case TranslatorLanguageCode::CEBUANO:
                return LingvanexLanguageCode::CEBUANO;
            case TranslatorLanguageCode::CHINESE_SIMPLIFIED:
                return LingvanexLanguageCode::CHINESE_SIMPLIFIED;
            case TranslatorLanguageCode::CHINESE_TRADITIONAL:
                return LingvanexLanguageCode::CHINESE_TRADITIONAL;
            case TranslatorLanguageCode::JAPANESE:
                return LingvanexLanguageCode::JAPANESE;
            case TranslatorLanguageCode::KOREAN:
                return LingvanexLanguageCode::KOREAN;
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
