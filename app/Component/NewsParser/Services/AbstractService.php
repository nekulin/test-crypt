<?php


namespace App\Component\NewsParser\Services;


use App\Component\NewsParser\Models\NewsModel;
use Illuminate\Support\Collection;

abstract class AbstractService
{
    protected Collection $config;

    public function __construct(Collection $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $theme
     * @return NewsModel[]
     */
    abstract public function parsing(string $theme) :array;
}
