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
use Translator\Translate\DTO\Input\MicrosoftTranslateRequestDTO;
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
        $this->microsoftTranslator = new MicrosoftTranslator($this->mockedGuzzleHTTPClient);
        // To Test Live Endpoint
        // $httpClient = new GuzzleHTTPClient();
        // $this->microsoftTranslator = new MicrosoftTranslator($httpClient);
    }

    /**
     * @test
     */
    public function it_correctly_translate_the_text_from_english_to_nepali()
    {
        // To Test Live Endpoint - Comment section below
        $mockedResponseContentFromMicrosoft = [
            [
                "translations" => [
                    [
                        'text' => 'नेपाल विश्वकै छाना हो ।',
                        'to' => 'ne'
                    ]
                ]
            ]
        ];

        $this
            ->mockedContent
            ->method('getContents')
            ->willReturn(
                json_encode($mockedResponseContentFromMicrosoft)
            );

        $translatedResponseDTO = $this
            ->microsoftTranslator
            ->setAuthorizationToken('a_valid_token') // Use valid key to test live endpoint
            ->setRegion('uksouth')
            ->translate(
                new MicrosoftTranslateRequestDTO(
                    'en',
                    'ne',
                    'Nepal is a roof of the world.'
                )
            );

        self::assertEquals('नेपाल विश्वकै छाना हो ।', $translatedResponseDTO->getTranslatedText());

    }

}
