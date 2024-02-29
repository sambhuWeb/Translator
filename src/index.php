<?php

require_once '../vendor/autoload.php';

use Translator\Client\GuzzleHTTPClient;
use Translator\HelloTranslator;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\Microsoft\MicrosoftTranslator;

echo HelloTranslator::sayHello();

echo '<br><br>';

echo '-------------------------------------------------------- <br>';
echo 'Microsoft Translation from en to nepali of "How are you?" will be: <br><br>';

$microsoftTranslator = new MicrosoftTranslator(new GuzzleHTTPClient());
$response = $microsoftTranslator
    ->setAuthorizationToken('6fd5215e93944af0ada5d5b7f4f5380b')
    ->setRegion('uksouth') //Always defaults to uksouth
    ->translate(
        new TranslateRequestDTO(
            'en',
            'ne',
            'Nepal is a roof of the world.'
        )
    );

echo $response->getTranslatedText();

echo '<br>-------------------------------------------------------- <br>';

