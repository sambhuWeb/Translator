<?php

namespace Translator\Tests\UnitTest\Lingvanex;

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
use Translator\Translate\Service\LanguageCode\LanguageCodeLookUpService;

class LingvanexTranslatorTest extends TestCase
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

    /** @var LingvanexTranslator */
    private $lingvanexTranslator;

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

        $this->lingvanexTranslator = new LingvanexTranslator($this->mockedGuzzleHTTPClient);
    }

    /**
     * @test
     */
    public function it_correctly_translate_the_text_from_english_to_nepali()
    {
        $mockedResponseContentFromLingvanex = [
            'err' => null,
            'result' => "हामी नेपाली हौं र हामी नेपाललाई माया गर्छौं।",
            'sourceTransliteration' => "We are Nepali and we love Nepal",
            'targetTransliteration' => "haamii nepaalii hauN r haamii nepaallaaii maayaa grchauN / "
        ];

        $this
            ->mockedContent
            ->method('getContents')
            ->willReturn(
                json_encode($mockedResponseContentFromLingvanex)
            )
        ;

        $translatedResponseDTO = $this
            ->lingvanexTranslator
            ->setAuthorizationToken('a-valid-token')
            ->translate(
                new TranslateRequestDTO(
                    LanguageCodeLookUpService::fetch('en_GB', Translator::LINGVANEX),
                    LanguageCodeLookUpService::fetch('ne', Translator::LINGVANEX),
                    'We are Nepali and we love Nepal',
                    true
                )
            )
        ;

        self::assertEquals('हामी नेपाली हौं र हामी नेपाललाई माया गर्छौं।', $translatedResponseDTO->getTranslatedText());
        self::assertEquals('We are Nepali and we love Nepal', $translatedResponseDTO->getSourceTextToBeTranslated());
        self::assertEquals(
            'haamii nepaalii hauN r haamii nepaallaaii maayaa grchauN / ',
            $translatedResponseDTO->getTransliteratedText()
        );
    }

    /**
     * @test
     */
    public function it_throws_exception_when_invalid_authorization_key_is_used()
    {
        $this->expectException(TranslatorException::class);

        $this
            ->mockedClient
            ->method('request')
            ->willThrowException($this->mockedGuzzleException)
        ;

        $this->lingvanexTranslator
            ->setAuthorizationToken('some-invalid-token')
            ->translate(
                new TranslateRequestDTO(
                    LanguageCodeLookUpService::fetch('en_GB', Translator::LINGVANEX),
                    LanguageCodeLookUpService::fetch('ne_NP', Translator::LINGVANEX),
                    'We are Nepali and we love Nepal',
                    true
                )
            )
        ;
    }

    /**
     * @test
     */
    public function it_throws_exception_when_invalid_language_code_is_used()
    {
        $this->expectException(TranslatorException::class);

        $this
            ->mockedClient
            ->method('request')
            ->willThrowException($this->mockedGuzzleException)
        ;

        $this->lingvanexTranslator
            ->setAuthorizationToken('a-valid-token')
            ->translate(
                new TranslateRequestDTO(
                    'aa_AA',
                    'bb_BB',
                    'I Love Nepal',
                    true
                )
            )
        ;
    }

    /**
     * @test
     */
    public function when_enable_transliteration_is_false_it_doesnot_return_transliteration_text()
    {
        $mockedResponseContentFromLingvanex = [
            'err' => null,
            'result' => "हामी नेपाली हौं र हामी नेपाललाई माया गर्छौं।"
        ];

        $this
            ->mockedContent
            ->method('getContents')
            ->willReturn(
                json_encode($mockedResponseContentFromLingvanex)
            )
        ;

        $translatedResponseDTO = $this
            ->lingvanexTranslator
            ->setAuthorizationToken('a-valid-token')
            ->translate(
                new TranslateRequestDTO(
                    LanguageCodeLookUpService::fetch('en', Translator::LINGVANEX),
                    LanguageCodeLookUpService::fetch('ne', Translator::LINGVANEX),
                    'We are Nepali and we love Nepal',
                    false
                )
            )
        ;

        self::assertEquals('हामी नेपाली हौं र हामी नेपाललाई माया गर्छौं।', $translatedResponseDTO->getTranslatedText());
        self::assertEmpty($translatedResponseDTO->getSourceTextToBeTranslated());
        self::assertEmpty($translatedResponseDTO->getTransliteratedText());
    }
}
