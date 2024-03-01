<?php

namespace Translator\Translate;

use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\DTO\Output\TranslatedResponseDTO;

interface Translator
{
    public function translate(TranslateRequestDTO $translateRequestDTO): TranslatedResponseDTO;
}
