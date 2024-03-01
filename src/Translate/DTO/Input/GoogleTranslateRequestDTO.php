<?php

namespace Translator\Translate\DTO\Input;

class GoogleTranslateRequestDTO implements TranslateRequestDTO
{
    /** @var string */
    private $from;

    /** @var string */
    private $to;

    /** @var string */
    private $data;

    public function __construct(
        string $fromLanguage,
        string $toLanguage,
        string $textToBeTranslated
    ) {
        $this->from = $fromLanguage;
        $this->to = $toLanguage;
        $this->data = $textToBeTranslated;
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
}
