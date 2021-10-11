<?php


namespace App\Component\NewsParser\Services;

use App\Component\NewsParser\Models\NewsModel;
use Illuminate\Support\Carbon;

class NewsApi extends AbstractService
{
    public function parsing(string $theme): array
    {
        $newsApi = new \jcobhams\NewsApi\NewsApi(
            api_key: $this->config->get('apiKey')
        );

        $result = collect(
            $newsApi->getEverything(q: $theme)
        );

        $news = [];

        foreach ($result->get('articles') as $article) {

            $newsModel = new NewsModel();

            $newsModel->hash = md5($article->url);
            $newsModel->sourceId = $article->source?->id;
            $newsModel->sourceName = $article->source?->name;
            $newsModel->theme = $theme;
            $newsModel->content = $article->content;
            $newsModel->url = $article->url;
            $newsModel->title = $article->title;
            $newsModel->description = $article->description;
            $newsModel->date = Carbon::parse($article->publishedAt);

            $news[] = $newsModel;
        }

        return $news;
    }
}
