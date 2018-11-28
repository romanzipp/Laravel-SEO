<?php

return [

    'shorthand' => [

        /**
         * Decide, which tags should be applied when using the
         * Seo Service shorthand methods like
         *
         * seo()->title(...)
         * seo()->description(...)
         */

        'title'       => [

            // <title>...</title>
            'tag'       => true,

            // <meta property="og:title" content="..." />
            'opengraph' => true,

            // <meta name="twitter:title" content="..." />
            'twitter'   => true,
        ],

        'description' => [

            // <meta property="og:description" content="..." />
            'opengraph' => true,

            // <meta name="twitter:description" content="..." />
            'twitter'   => true,
        ],
    ],
];
