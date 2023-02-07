<?php

namespace JohnPaulMedina\ShortUrl\Console\Commands;

use Illuminate\Console\Command;

class BuildShortUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shorturl:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a shortened url';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
