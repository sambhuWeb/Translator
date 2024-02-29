<?php

namespace Translator\Tests\UnitTest\Microsoft;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Translator\Client\GuzzleHTTPClient;
use Translator\Translate\Constant\Translator;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Lingvanex\LingvanexTranslator;
use Translator\Translate\Microsoft\MicrosoftTranslator;
use Translator\Translate\Service\LanguageCode\LanguageCodeLookUpService;

class MicrosoftTranslatorTest extends TestCase
{
    /** @var GuzzleException|MockObject */
    private $mockedGuzzleException;

    /** @var MockObject|GuzzleHTTPClient */
    private $mockedGuzzleHTTPClient;

    /** @var Client|MockObject */
    private $mockedClient;

    /** @var Client|MockObject */
    private $mockedResponse;

    /** @var Client|MockObject */
    private $mockedContent;

    /** @var MicrosoftTranslator */
    private $microsoftTranslator;

    public function setUp()
    {
        $this->mockedGuzzleException = $this
            ->getMockBuilder(GuzzleException::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->mockedGuzzleHTTPClient = $this
            ->getMockBuilder(GuzzleHTTPClient::class)
            ->setMethods(['getClient'])
            ->getMock()
        ;

        $this->mockedClient = $this
            ->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['request'])
            ->getMock()
        ;

        $this->mockedResponse = $this
            ->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->setMethods(['getBody'])
            ->getMock()
        ;

        $this->mockedContent = $this
            ->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->setMethods(['getContents'])
            ->getMock()
        ;

        $this->mockedClient->method('request')->willReturn($this->mockedResponse);
        $this->mockedResponse->method('getBody')->willReturn($this->mockedContent);
        $this->mockedGuzzleHTTPClient->method('getClient')->willReturn($this->mockedClient);
//        $this->microsoftTranslator = new MicrosoftTranslator($this->mockedGuzzleHTTPClient);
        $httpClient = new GuzzleHTTPClient();
        $this->microsoftTranslator = new MicrosoftTranslator($httpClient);
    }

    /**
     * @test
     */
    public function it_correctly_translate_the_text_from_english_to_nepali()
    {
//        $mockedResponseContentFromMicrosoft = [
//            [
//                "translations" => [
//                    [
//                        'text' => 'नेपाल विश्वकै छाना हो ।',
//                        'to' => 'ne'
//                    ]
//                ]
//            ]
//        ];
//
//        $this
//            ->mockedContent
//            ->method('getContents')
//            ->willReturn(
//                json_encode($mockedResponseContentFromMicrosoft)
//            );

        $translatedResponseDTO = $this
            ->microsoftTranslator
            ->setAuthorizationToken('6fd5215e93944af0ada5d5b7f4f5380b')
            ->setRegion('uksouth')
            ->translate(
                new TranslateRequestDTO(
                    'en',
                    'ne',
                    'Nepal is a roof of the world.'
                )
            );

        self::assertEquals('नेपाल विश्वकै छाना हो ।', $translatedResponseDTO->getTranslatedText());

    }

}
