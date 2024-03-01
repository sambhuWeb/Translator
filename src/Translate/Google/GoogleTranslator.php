<?php

namespace Translator\Translate\Google;

use Google\Cloud\Core\Exception\BadRequestException;
use Google\Cloud\Translate\V2\TranslateClient;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\DTO\Output\TranslatedResponseDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Translator;

class GoogleTranslator implements Translator
{
    /**
     * @var TranslateClient $translateClient
     */
    private $translateClient;

    /**
     * @param TranslateClient $translateClient
     */
    public function __construct(TranslateClient $translateClient)
    {
        $this->translateClient = $translateClient;
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
        try {
            $responseBody = $this->translateClient->translate(
                $translateRequestDTO->getData(),
                [
                    'target' => $translateRequestDTO->getTo(),
                    'source' => $translateRequestDTO->getFrom()
                ]
            );
        } catch (BadRequestException $exception) {
            $deserializedExceptionMessage = $this->deserializeJsonToArray($exception->getMessage());

            if (is_array($deserializedExceptionMessage) && isset($deserializedExceptionMessage['error']['message'])) {
                throw new TranslatorException($deserializedExceptionMessage['error']['message']);
            }

            throw new TranslatorException('Unable to parse Google Translation Exception');
        }
        
        return new TranslatedResponseDTO(
            $responseBody['text'],
            $responseBody['input'],
            ''
        );
    }

    /**
     * @param $message
     * @return mixed
     * @throws TranslatorException
     */
    private function deserializeJsonToArray($message)
    {
        try {
            return $this->serializer->deserialize(
                $message,
                'array',
                'json'
            );
        } catch (\Exception $e) {
            throw new TranslatorException('Unable to deserialize: ' . $e->getMessage());
        }
    }
}
