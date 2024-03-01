<?php

namespace Translator\Translate\DTO\Input;

class LingvanexTranslateRequestDTO implements TranslateRequestDTO
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var string */
    private $data;

    /** @var bool */
    private $enableTransliteration;

    /** @var string */
    private $platform;

    public function __construct(
        string $fromLanguage,
        string $toLanguage,
        string $textToBeTranslated,
        bool $enableTransliteration = false,
        string $platform = 'api'
    ) {
        $this->from = $fromLanguage;
        $this->to = $toLanguage;
        $this->data = $textToBeTranslated;
        $this->enableTransliteration = $enableTransliteration;
        $this->platform = $platform;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function isEnableTransliteration(): bool
    {
        return $this->enableTransliteration;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }
}
