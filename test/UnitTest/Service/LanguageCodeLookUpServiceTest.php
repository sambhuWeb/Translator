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

        // South Asia
        // Nepali
        yield['ne', 'ne_NP'];
        // Hindi
        yield['hi', 'hi_IN'];
        // Tamil
        yield['ta', 'ta_IN'];
        // Telugu
        yield['te', 'te_IN'];
        // Malayalam
        yield['ml', 'ml_IN'];
        // Kannada
        yield['kn', 'kn_IN'];
        // Sinhala
        yield['si', 'si_LK'];
        // Punjabi
        yield['pa', 'pa_PK'];
        // Gujarati
        yield['gu', 'gu_IN'];
        // Marathi
        yield['mr', 'mr_IN'];
        // Oria
        yield['or', 'or_OR'];
        // Bangla
        yield['bn', 'bn_BD'];
        // Urdu
        yield['ur', 'ur_PK'];
        // Sindhi
        yield['sd', 'sd_PK'];
        // Pashto
        yield['ps', 'ps_AF'];
        // Kurdish
        yield['ku', 'ku_IR'];

        // Middle East
        // Arabic
        yield['ar', 'ar_AE'];
        // Persian
        yield['fa', 'fa_IR'];
        // Hebrew
        yield['he', 'he_IL'];

        // South East Asia
        // Thai
        yield['th', 'th_TH'];
        // Myanmar (Burmese)
        yield['my', 'my_MM'];
        // Vietnamese
        yield['vi', 'vi_VN'];
        // Lao
        yield['lo', 'lo_LA'];
        // Indonesian
        yield['id', 'id_ID'];
        // Javanese
        yield['jv', 'jv_ID'];
        // Khmer
        yield['km', 'km_KH'];
        // Malay
        yield['ms', 'ms_MY'];
        // Tagalog
        yield['tl', 'tl_PH'];
        // Cebuano
        yield['ceb', 'ceb_PH'];

        // East Asia
        // Chinese (Simplified)
        yield['zh', 'zh-Hans_CN'];
        // Chinese (Traditional)
        yield['zh-TW', 'zh-Hant_TW'];
        // Japanese
        yield['ja', 'ja_JP'];
        // Korean
        yield['ko', 'ko_KR'];

        // Europe
        // Greek
        yield['el', 'el_GR'];
        // Spanish
        yield['es', 'es_ES'];
        // Italian
        yield['it', 'it_IT'];
        // Portuguese
        yield['pt', 'pt_PT'];
        // German
        yield['de', 'de_DE'];

        // Africa
        // Amharic
        yield['am', 'am_ET'];
        // Swahili
        yield['sw', 'sw_TZ'];
        // Afrikaans
        yield['af', 'af_ZA'];
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
