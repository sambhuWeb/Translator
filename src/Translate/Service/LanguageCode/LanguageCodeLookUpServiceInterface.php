<?php

namespace Translator\Translate\Service\LanguageCode;

interface LanguageCodeLookUpServiceInterface
{
    /**
     * @param string $languageCode
     * @return string
     */
    public static function fetch(string $languageCode): string;
}
