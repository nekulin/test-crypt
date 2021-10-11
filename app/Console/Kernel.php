<?php

namespace App\Console;

use App\Console\Commands\NewsParser;
use App\Jobs\ParserJob;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NewsParser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $parserThemes = collect(config('news_parser'))->get('themes');

        foreach ($parserThemes as $parserTheme) {

            $schedule->job(new ParserJob(theme: $parserTheme))
                ->everyFiveMinutes();
        }
    }
}
