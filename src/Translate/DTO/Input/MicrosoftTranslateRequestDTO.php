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

    /** @var string */
    private $apiVersion;

    public function __construct(
        string $fromLanguage,
        string $toLanguage,
        string $textToBeTranslated,
        string $apiVersion = '3.0'
    ) {
        $this->from = $fromLanguage;
        $this->to = $toLanguage;
        $this->data = $textToBeTranslated;
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

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }
}
