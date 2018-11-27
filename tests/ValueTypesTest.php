<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class ValueTypesTest extends TestCase
{
    public function testStructBodyNullValueType()
    {
        seo()->add(
            Title::make()->body(null)
        );

        $title = seo()->getStructs()[0];

        $this->assertNull($title->getBody()->data());
    }

    public function testStructBodyEmptyStringValueType()
    {
        seo()->add(
            Title::make()->body('')
        );

        $title = seo()->getStructs()[0];

        $this->assertTrue(is_string($title->getBody()->data()));
    }

    public function testHookCallbackBodyType()
    {
        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {

                    $this->assertTrue(is_string($body));

                    return $body;
                })
        );

        seo()->add(
            Title::make()->body('My Title')
        );

        Title::clearHooks();
    }

    public function testHookCallbackNullableBodyType()
    {
        Title::hook(
            Hook::make()
                ->onBody()
                ->callback(function ($body) {

                    $this->assertNull($body);

                    return $body;
                })
        );

        seo()->add(
            Title::make()->body(null)
        );

        Title::clearHooks();
    }
}
