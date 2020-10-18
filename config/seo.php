<?php

return [
    'shorthand' => [
        /*
         * Decide, which tags should be created when using the
         * Seo Service shorthand methods like seo()->title(...)
         */

        'title' => [
            // <title>...</title>
            'tag' => true,

            // <meta property="og:title" content="..." />
            'opengraph' => true,

            // <meta name="twitter:title" content="..." />
            'twitter' => true,
        ],

        'description' => [
            // <meta name="description" content="..." />
            'meta' => true,

            // <meta property="og:description" content="..." />
            'opengraph' => true,

            // <meta name="twitter:description" content="..." />
            'twitter' => true,
        ],

        'image' => [
            // <meta name="image" content="..." />
            'meta' => true,

            // <meta property="og:image" content="..." />
            'opengraph' => true,

            // <meta name="twitter:image" content="..." />
            'twitter' => true,
        ],
    ],
];
