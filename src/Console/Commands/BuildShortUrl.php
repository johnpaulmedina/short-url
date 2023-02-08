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
    protected $signature = 'shorturl:build 
                            {url : The destination url } 
                            {--key= : Custom key for pretty url routing }';

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
        $builder = new \JohnPaulMedina\ShortUrl\Classes\Builder();

        $shortURLObject = $builder->destinationUrl(urldecode($this->argument('url')));

        // if(request()->has('urlKey') && request()->input('urlKey')) {
        //     $shortURLObject = $shortURLObject->urlKey(request()->input('urlKey'));
        // }

        $shortURLObject = $shortURLObject->make();
        $shortURL = $shortURLObject->default_short_url;

        $this->table(
            ['Destination', 'Short Url'],
            [$shortURLObject->destination, $shortURLObject->default_short_url]
        );
    }
}
