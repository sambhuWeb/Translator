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
        // English
        yield['en', 'en_GB'];
        yield['en_GB', 'en_GB'];
        // Nepali
        yield['ne', 'ne_NP'];
        yield['ne_NP', 'ne_NP'];
        // Hindi
        yield['hi', 'hi_IN'];
        yield['hi_IN', 'hi_IN'];
        // Tamil
        yield['ta', 'ta_IN'];
        yield['ta_IN', 'ta_IN'];
        // Malayalam
        yield['ml', 'ml_IN'];
        yield['ml_IN', 'ml_IN'];
        // Kannada
        yield['kn', 'kn_IN'];
        yield['kn_IN', 'kn_IN'];
        // Sinhala
        yield['si', 'si_LK'];
        yield['si_LK', 'si_LK'];
        // Bangla
        yield['bn', 'bn_BD'];
        yield['bn_BD', 'bn_BD'];
        // Urdu
        yield['ur', 'ur_PK'];
        yield['ur_PK', 'ur_PK'];
        // Arabic
        yield['ar', 'ar_AE'];
        yield['ar_AE', 'ar_AE'];
        // Malay
        yield['ms', 'ms_MY'];
        yield['ms_MY', 'ms_MY'];
        // Tagalog
        yield['tl', 'tl_PH'];
        yield['tl_PH', 'tl_PH'];
        // Greek
        yield['el', 'el_GR'];
        yield['el_GR', 'el_GR'];
    }

    /**
     * @return \Generator
     */
    public function googleLanguageCodeProvider(): \Generator
    {
        yield['el', 'el'];
        yield['ar', 'ar'];
    }
}
