<?php

namespace Translator\Translate\DTO\Output;

class TranslatedResponseDTO
{
    /** @var string */
    private $translatedText;

    /** @var string */
    private $sourceTextToBeTranslated;

    /** @var string */
    private $targetTransliteration;

    public function __construct(
        string $translatedText,
        string $sourceTextToBeTranslated,
        string $transliteratedText
    ) {
        $this->translatedText = $translatedText;
        $this->sourceTextToBeTranslated = $sourceTextToBeTranslated;
        $this->targetTransliteration = $transliteratedText;
    }

    public function getTranslatedText(): string
    {
        return $this->translatedText;
    }

    public function getSourceTextToBeTranslated(): string
    {
        return $this->sourceTextToBeTranslated;
    }

    public function getTransliteratedText(): string
    {
        return $this->targetTransliteration;
    }
}
