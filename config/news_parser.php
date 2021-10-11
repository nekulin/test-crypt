<?php
return [

    'themes' => [
        'Bitcoin',
        'Litecoin',
        'Ripple',
        'Dash',
        'Ethereum',
    ],

    'services' => [

        'NewsApi' => [
            'class' => \App\Component\NewsParser\Services\NewsApi::class,
            'apiKey' => env('NEWS_API_KEY'),
        ],
    ],
];
