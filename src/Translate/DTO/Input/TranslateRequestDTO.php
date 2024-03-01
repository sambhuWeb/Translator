<?php

namespace Translator\Translate\DTO\Input;

interface TranslateRequestDTO
{
    public function getFrom(): string;
    public function getTo(): string;
    public function getData(): string;
    public function isEnableTransliteration(): bool;
}
