<?php

if (!function_exists('parsing')) {

    /**
     * @param string $service
     * @param string $theme
     * @return \App\Component\NewsParser\Models\NewsModel[]|null
     */
    function parsing(string $service, string $theme) :?array
    {
        /** @var \App\Component\NewsParser\NewsParser $app */
        $app = app('newsParser');

        return $app->parsing(
            service: $service,
            theme: $theme,
        );
    }
}
