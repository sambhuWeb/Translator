<?php

namespace Translator\Translate\Microsoft;

use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Translator\Client\GuzzleHTTPClient;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\DTO\Output\TranslatedResponseDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Translator;

class MicrosoftTranslator implements Translator
{
    /** @var GuzzleHTTPClient */
    private $httpClient;

    /** @var Serializer */
    private $serializer;

    /** @var string */
    private $token;

    /** @var string */
    private $region = 'uksouth';

    public function __construct(GuzzleHTTPClient $httpClient)
    {
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
                'translate',
                [
                    'body' => $this->serializer->serialize(
                        [
                            [
                                'text' => $translateRequestDTO->getData()
                            ]
                        ],
                        'json'
                    ),
                    'query' => [
                        'api-version' => $translateRequestDTO->getApiVersion(),
                        'from' => $translateRequestDTO->getFrom(),
                        'to' => $translateRequestDTO->getTo()
                    ]
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
            $responseBody[0]['translations'][0]['text'],
            $translateRequestDTO->getData() ?? '',
            ''
        );
    }

    private function getClientConfig(): array
    {
        return [
            'base_uri' => 'https://api.cognitive.microsofttranslator.com',
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->getAuthorizationToken(),
                'Ocp-Apim-Subscription-Region' => $this->getRegion(),
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

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }
}
