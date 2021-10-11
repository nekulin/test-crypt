<?php

namespace App\Console\Commands;

use App\Jobs\ParserJob;
use Illuminate\Console\Command;

class NewsParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:parser {theme}';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dispatch_now(new ParserJob($this->argument('theme')));
    }
}
