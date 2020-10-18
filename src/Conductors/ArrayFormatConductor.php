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

    /**
     * Get the predefined schemas for array formatting.
     *
     * @return array
     */
    private function getSchemas(): array
    {
        return [
            /*
             * Single key-value pair.
             *
             *     $data = [
             *         'title' => 'Foo'
             *     ];
             */

            'title' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->title($value);
            }),

            'description' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->description($value);
            }),

            'charset' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->charset($value);
            }),

            'viewport' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->viewport($value);
            }),

            'canonical' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->canonical($value);
            }),

            'image' => SingleArraySchema::make()->callback(function (string $value) {
                $this->seo->image($value);
            }),

            /*
             * Nested item with key-value pairs.
             *
             *     $data = [
             *         'twitter' => [
             *             'card' => 'summary',
             *             'creator' => '@romanzipp'
             *         ]
             *     ];
             */

            'twitter' => NestedArraySchema::make()->callback(function (string $attribute, string $value) {
                $this->seo->twitter($attribute, $value);
            }),

            'og' => NestedArraySchema::make()->callback(function (string $attribute, string $value) {
                $this->seo->og($attribute, $value);
            }),

            /*
             * Item with attribute schema.
             *
             *     $data = [
             *         'meta' => [
             *             [
             *                 'name' => 'copyright',
             *                 'content' => 'Roman Zipp'
             *             ],
             *             [
             *                 'name' => 'theme-color',
             *                 'content' => 'red'
             *             ]
             *         ]
             *     ];
             */

            'meta' => AttributeArraySchema::make(Structs\Meta::class)->callback(function (Structs\Meta $struct, array $attributes) {
                $this->seo->add(
                    $struct->attrs($attributes)
                );
            }),

            'link' => AttributeArraySchema::make(Structs\Link::class)->callback(function (Structs\Link $struct, array $attributes) {
                $this->seo->add(
                    $struct->attrs($attributes)
                );
            }),
        ];
    }

    /**
     * Get a array schema based on index.
     *
     * @param string $index
     *
     * @return \romanzipp\Seo\Conductors\ArrayStructures\AbstractArraySchema|null
     */
    private function getSchema(string $index): ?AbstractArraySchema
    {
        return $this->getSchemas()[$index] ?? null;
    }

    /**
     * Set the array data and pass it to the seo service.
     *
     * @param array $data
     */
    public function setData(array $data): void
    {
        foreach ($data as $key => $value) {
            $schema = $this->getSchema($key);

            if (null === $schema) {
                throw new InvalidArgumentException("Unknown key {$key} provided for seo array format");
            }

            $schema->apply($value);
        }
    }
}
