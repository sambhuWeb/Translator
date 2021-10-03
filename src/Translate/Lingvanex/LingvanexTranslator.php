<?php

namespace Translator\Translate\Lingvanex;

use Translator\Client\GuzzleHTTPClient;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\DTO\Output\TranslatedResponseDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Translator;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class LingvanexTranslator implements Translator
{
    /** @var GuzzleHTTPClient */
    private $httpClient;

    /** @var Serializer */
    private $serializer;

    /** @var string */
    private $token;

    public function __construct(
        GuzzleHTTPClient $httpClient
    ) {
        $this->httpClient = $httpClient;
        $this->serializer = SerializerBuilder::create()->setPropertyNamingStrategy(
            new SerializedNameAnnotationStrategy(
                new IdenticalPropertyNamingStrategy()
            )
        )->build();
    }

    /**
     * @param TranslateRequestDTO $translateRequestDTO
     * @return TranslatedResponseDTO
     * @throws TranslatorException
     */
    public function translate(TranslateRequestDTO $translateRequestDTO): TranslatedResponseDTO
    {
        $client = $this->httpClient->getClient($this->getClientConfig());

        try {
            $response = $client->request(
                'POST',
                'b1/api/v3/translate',
                [
                    'debug' => false,
                    'body' => $this->serializer->serialize($translateRequestDTO, 'json')
                ]
            );
        } catch (GuzzleException $exception) {
            throw new TranslatorException($exception->getMessage());
        }

        $responseBody = $this->serializer->deserialize(
            $response->getBody()->getContents(),
            'array',
            'json'
        );

        return new TranslatedResponseDTO(
            $responseBody['result'],
            $responseBody['sourceTransliteration'],
            $responseBody['targetTransliteration']
        );
    }

    /**
     * @return array
     */
    private function getClientConfig(): array
    {
        return [
            'base_uri' => 'https://api-b2b.backenster.com/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAuthorizationToken(),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json'
            ],
        ];
    }

    public function setAuthorizationToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getAuthorizationToken(): string
    {
        return $this->token;
    }
}
