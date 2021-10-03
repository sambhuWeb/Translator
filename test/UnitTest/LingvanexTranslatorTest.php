<?php

namespace test\UnitTest;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use http\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use Translator\Client\GuzzleHTTPClient;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Lingvanex\LingvanexTranslator;
use PHPUnit\Framework\TestCase;

class LingvanexTranslatorTest extends TestCase
{
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

        $this->mockedResponse->method('getBody')->willReturn($this->mockedContent);
        $this->mockedClient->method('request')->willReturn($this->mockedResponse);
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
            ->setAuthorizationToken('some-token')
            ->translate(
                new TranslateRequestDTO(
                    'en_GB',
                    'ne_NP',
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

        $lingvanexTranslator = new LingvanexTranslator(new GuzzleHTTPClient);

        $lingvanexTranslator
            ->setAuthorizationToken('some invalid key')
            ->translate(
                new TranslateRequestDTO(
                    'en_GB',
                    'ne_NP',
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

        $lingvanexTranslator = new LingvanexTranslator(new GuzzleHTTPClient);

        $token = 'a_tme3wcJhZa9fWi0hmc5MV10RVnPQ0LsXYpZHIIM7GSvJf3PZUwNkTY3VBFUdJmXc4xdJe0hW9WITxo7s';

        $lingvanexTranslator
            ->setAuthorizationToken($token)
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
}
