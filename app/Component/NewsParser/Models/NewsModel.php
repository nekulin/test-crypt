<?php


namespace App\Component\NewsParser\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsModel
{
    public string $hash;

    public string $theme;

    public string $content;

    public string $url;

    public Carbon $date;

    public ?string $title = null;

    public ?string $description = null;

    public ?string $sourceId = null;

    public ?string $sourceName = null;

    public function normalization()
    {
        $this->theme = Str::lower($this->theme);

        if (is_null($this->sourceId)) {

            $this->sourceId = Str::lower($this->sourceName);
        }
    }
}
