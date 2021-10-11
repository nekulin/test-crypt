<?php


namespace App\Component\NewsParser;


use App\Component\NewsParser\Models\NewsModel;
use App\Component\NewsParser\Services\AbstractService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class NewsParser
{
    public Collection $config;

    public function __construct(Collection $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $service
     * @param string $theme
     * @return NewsModel[]|null
     */
    public function parsing(string $service, string $theme) :?array
    {
        $services = $this->config->get('services', []);

        if (!key_exists($service, $services)) {

            Log::error('NewsParser  ' . $service . ' is not valid.');

            return null;
        }

        try {

            $class = $services[$service]['class'];

            /** @var AbstractService $class */
            $class = new $class(config: collect($services[$service]));

            return $class->parsing(theme: $theme);

        } catch (\Throwable $e) {

            dd($e);

            Log::error('NewsParser  ' . $service . ': ' . $e->getMessage(), $e->getTrace());

            return null;
        }
    }
}
