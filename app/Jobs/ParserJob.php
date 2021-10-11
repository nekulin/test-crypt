<?php

namespace App\Jobs;

use App\Models\News;
use App\Models\NewsSource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ParserJob extends Job
{
    private string $theme;

    /**
     * @param string $theme
     */
    public function __construct(string $theme)
    {
        $this->theme = $theme;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $services = config('news_parser');

        foreach (array_keys($services['services']) as $service) {

            $newsItems = parsing(
                service: $service,
                theme: $this->theme
            );

            if (is_null($newsItems)) {

                continue;
            }

            foreach ($newsItems as $newsItem) {

                $newsItem->hash = md5($service . $newsItem->hash);

                $newsItem->normalization();

                $news = News::whereHash($newsItem->hash)
                    ->exists();

                if ($news || empty($newsItem->sourceId)) {

                    continue;
                }

                $source = NewsSource::whereSourceId($newsItem->sourceId)
                    ->first();

                if (!$source) {

                    $source = new NewsSource();
                    $source->source_id = $newsItem->sourceId;
                    $source->source_name = $newsItem->sourceName;
                    $source->saveOrFail();
                }

                $news = new News();
                $news->hash = $newsItem->hash;
                $news->news_source_id = $source->id;
                $news->title = Str::substr($newsItem->title, 0, 255);
                $news->theme = Str::substr($newsItem->theme, 0, 150);
                $news->url = Str::substr($newsItem->url, 0, 255);
                $news->description = Str::substr($newsItem->description, 0, 1000);
                $news->content = Str::substr($newsItem->content, 0, 5000);
                $news->date_at = $newsItem->date;
                $news->created_at = Carbon::now();
                $news->save();
            }
        }
    }
}
