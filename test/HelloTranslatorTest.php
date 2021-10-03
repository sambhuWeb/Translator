<?php

namespace test;

use PHPUnit\Framework\TestCase;
use Translator\HelloTranslator;

class HelloTranslatorTest extends TestCase
{
    /**
     * @test
     */
    public function display_hello_world_message()
    {
        self::assertEquals(
            'Hello translators',
            HelloTranslator::sayHello()
        );
    }
}
