<?php

namespace test\UnitTest;

use Translator\Client\GuzzleHTTPClient;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Lingvanex\LingvanexTranslator;
use PHPUnit\Framework\TestCase;

class LingvanexTranslatorTest extends TestCase
{
    /**
     * @var LingvanexTranslator
     */
    private $lingvanexTranslator;

    public function setUp()
    {
        $httpClient = new GuzzleHTTPClient;
        $this->lingvanexTranslator = new LingvanexTranslator($httpClient);
    }

    /**
     * @test
     */
    public function it_correctly_translate_the_text_from_english_to_nepali()
    {
        $token = 'a_tme3wcJhZa9fWi0hmc5MV10RVnPQ0LsXYpZHIIM7GSvJf3PZUwNkTY3VBFUdJmXc4xdJe0hW9WITxo7s';

        $translatedResponseDTO = $this
            ->lingvanexTranslator
            ->setAuthorizationToken($token)
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

        $this
            ->lingvanexTranslator
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

        $this
            ->lingvanexTranslator
            ->setAuthorizationToken('some invalid key')
            ->translate(
                new TranslateRequestDTO(
                    'aa_AA',
                    'bb_BB',
                    'We are Nepali and we love Nepal.',
                    true
                )
            )
        ;
    }
}
