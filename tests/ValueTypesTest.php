<?php

namespace romanzipp\Seo\Test;

use romanzipp\Seo\Facades\Seo;
use romanzipp\Seo\Helpers\Hook;
use romanzipp\Seo\Structs\Meta;
use romanzipp\Seo\Structs\Title;
use romanzipp\Seo\Test\TestCase;

class ValueTypesTest extends TestCase
{
    public function testStructBodyNullValueType()
    {
        seo()->add(
            Title::make()->body(null)
        );

        $struct = seo()->getStructs()[0];

        $this->assertNull($struct->getBody()->data());
    }

    public function testStructBodyEmptyStringValueType()
    {
        seo()->add(
            Title::make()->body('')
        );

        $struct = seo()->getStructs()[0];

        $this->assertTrue(is_string($struct->getBody()->data()));
    }

    public function testStructAttributeNullValueType()
    {
        seo()->add(
            Meta::make()->attr('name', null)
        );

        $struct = seo()->getStructs()[0];

        $attribute = $struct->getAttributes()['name'];

        $this->assertNull($attribute->data());
    }

    public function testStructAttributeEmptyStringValueType()
    {
        seo()->add(
            Meta::make()->attr('name', '')
        );

        $struct = seo()->getStructs()[0];

        $attribute = $struct->getAttributes()['name'];

        $this->assertTrue(is_string($attribute->data()));
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
