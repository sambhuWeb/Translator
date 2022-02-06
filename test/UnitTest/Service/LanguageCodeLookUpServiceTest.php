<?php

namespace test\UnitTest\Service;

use PHPUnit\Framework\TestCase;
use Translator\Translate\Constant\Translator;
use Translator\Translate\Service\LanguageCode\LanguageCodeLookUpService;

class LanguageCodeLookUpServiceTest extends TestCase
{
    /**
     * @dataProvider lingvanexLanguageCodeProvider
     * @test 
     */
    public function it_return_correct_language_code_for_lingvanex_translator(
        $providedLanguageCode,
        $expectedLanguageCode
    ) {
        // Action or When
        $actualLanguageCode = LanguageCodeLookUpService::fetch($providedLanguageCode, Translator::LINGVANEX);

        // Assert or Then
        self::assertSame($expectedLanguageCode, $actualLanguageCode);
    }

    /**
     * @dataProvider googleLanguageCodeProvider
     * @test
     */
    public function it_return_correct_language_code_for_google_translator(
        $providedLanguageCode,
        $expectedLanguageCode
    ) {
        // Action or When
        $actualLanguageCode = LanguageCodeLookUpService::fetch($providedLanguageCode, Translator::GOOGLE);

        // Assert or Then
        self::assertSame($expectedLanguageCode, $actualLanguageCode);
    }

    /**
     * @return \Generator
     */
    public function lingvanexLanguageCodeProvider(): \Generator
    {
        yield['el', 'el_GR'];
        yield['el_GR', 'el_GR'];
    }

    /**
     * @return \Generator
     */
    public function googleLanguageCodeProvider(): \Generator
    {
        yield['el', 'el'];
    }
}
