<?php

namespace romanzipp\Seo\Conductors;

use InvalidArgumentException;
use romanzipp\Seo\Conductors\ArrayStructures\AbstractArraySchema;
use romanzipp\Seo\Conductors\ArrayStructures\AttributeArraySchema;
use romanzipp\Seo\Conductors\ArrayStructures\NestedArraySchema;
use romanzipp\Seo\Conductors\ArrayStructures\SingleArraySchema;
use romanzipp\Seo\Services\SeoService;
use romanzipp\Seo\Structs;

class ArrayFormatConductor
{
    /**
     * @var \romanzipp\Seo\Services\SeoService
     */
    private $seo;

    public function __construct(SeoService $seo)
    {
        $this->seo = $seo;
    }

    private function getSchemas(): array
    {
        return [

            // Single value structures

            'title' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->title($value);
            }),

            'description' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->description($value);
            }),

            // Nested key-value pairs [ 'schema' => [ 'key1' => 'value1', 'key2' => 'value2' ] ]

            'twitter' => NestedArraySchema::make()->callback(function (string $key, string $value) {
                $this->seo->twitter($key, $value);
            }),

            'og' => NestedArraySchema::make()->callback(function (string $key, string $value) {
                $this->seo->og($key, $value);
            }),

            // Attributes schema [ 'schema' => [ ['attribute' => 'value'], ['attribute' => 'value'] ] ]

            'meta' => AttributeArraySchema::make(Structs\Meta::class)->callback(function (Structs\Meta $struct, array $attributes) {

                foreach ($attributes as $key => $value) {
                    $struct->attr($key, $value);
                }

                $this->seo->add($struct);
            }),

        ];
    }

    private function getSchema(string $index): ?AbstractArraySchema
    {
        return $this->getSchemas()[$index] ?? null;
    }

    public function setData(array $data)
    {
        foreach ($data as $key => $value) {

            $schema = $this->getSchema($key);

            if ($schema === null) {
                throw new InvalidArgumentException("Unknown key {$key}");
            }

            $schema->apply($value);
        }
    }
}
