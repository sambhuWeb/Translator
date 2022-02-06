<?php

namespace test\UnitTest\Google;

use Google\Cloud\Core\Exception\BadRequestException;
use Google\Cloud\Translate\V2\TranslateClient;
use PHPUnit\Framework\TestCase;
use Translator\Translate\Constant\Translator;
use Translator\Translate\DTO\Input\TranslateRequestDTO;
use Translator\Translate\Exception\TranslatorException;
use Translator\Translate\Google\GoogleTranslator;
use Translator\Translate\Service\LanguageCode\LanguageCodeLookUpService;

class GoogleTranslatorTest extends TestCase
{
    /**
     * @var TranslateClient
     */
    private $mockedTranslateClient;
    
    public function setUp()
    {
        $this->mockedTranslateClient = $this
            ->getMockBuilder(TranslateClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['translate'])
            ->getMock()
        ;
    }
    
    /**
     * @test
     */
    public function it_correctly_translate_the_text_from_english_to_nepali()
    {
        $this
            ->mockedTranslateClient
            ->method('translate')
            ->willReturn(
                [
                    'input' => 'We are Nepali and we love Nepal',
                    'text' => 'हामी नेपाली हौं र नेपाललाई माया गर्छौं'
                ]
            )
        ;
        
        $googleTranslator = new GoogleTranslator($this->mockedTranslateClient);
        
        $translatedResponseDTO = $googleTranslator->translate(
            new TranslateRequestDTO(
                LanguageCodeLookUpService::fetch('en', Translator::GOOGLE),
                LanguageCodeLookUpService::fetch('ne', Translator::GOOGLE),
                'We are Nepali and we love Nepal',
                true
            )
        );

        self::assertSame(
            'हामी नेपाली हौं र नेपाललाई माया गर्छौं',
            $translatedResponseDTO->getTranslatedText()
        );

        self::assertSame(
            'We are Nepali and we love Nepal',
            $translatedResponseDTO->getSourceTextToBeTranslated()
        );
        
        self::assertEmpty($translatedResponseDTO->getTransliteratedText());
    }

    /**
     * @test
     */
    public function it_throws_exception_when_invalid_language_code_is_used()
    {
        $this->expectException(TranslatorException::class);

        $mockedGoogleBadRequestException = $this
            ->getMockBuilder(BadRequestException::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this
            ->mockedTranslateClient
            ->method('translate')
            ->willThrowException($mockedGoogleBadRequestException)
        ;

        $googleTranslator = new GoogleTranslator($this->mockedTranslateClient);

        $googleTranslator->translate(
            new TranslateRequestDTO(
                'en',
                'aa',
                'We are Nepali and we love Nepal',
                true
            )
        );
    }
}
