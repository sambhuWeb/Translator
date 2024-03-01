<?php

namespace Translator\Translate\DTO\Input;

class MicrosoftTranslateRequestDTO implements TranslateRequestDTO
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
    private $apiVersion;

    public function __construct(
        string $fromLanguage,
        string $toLanguage,
        string $textToBeTranslated,
        bool $enableTransliteration = false,
        string $apiVersion = '3.0'
    ) {
        $this->from = $fromLanguage;
        $this->to = $toLanguage;
        $this->data = $textToBeTranslated;
        $this->enableTransliteration = $enableTransliteration;
        $this->apiVersion = $apiVersion;
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

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }
}
