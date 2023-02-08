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
    protected $signature = 'shorturl:build {url : The destination url }';

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

        $url = $this->argument('url');

        if ($this->confirm('Would you like to append UTM Tracking?', true)) {
            
            $utm = [
                'utm_id' => null,
                'utm_source' => null,
                'utm_medium' => null,
                'utm_campaign' => null,
                'utm_term' => null,
                'utm_content' => null
            ];

            $this->warn('You may skip any utm item by leaving them blank.');

            $this->info('Used to identify which ads campaign this referral references. Use utm_id to identify a specific ads campaign.');
            $utm['utm_id'] = $this->ask('UTM Campaign ID:');

            $this->info('Use utm_source to identify a search engine, newsletter name, or other source.');
            $utm['utm_source'] = $this->ask('UTM Source:');

            $this->info('Use utm_medium to identify a medium such as email or cost-per-click.');
            $utm['utm_medium'] = $this->ask('UTM Medium:');

            $this->info('Used for keyword analysis. Use utm_campaign to identify a specific product promotion or strategic campaign.');
            $utm['utm_campaign'] = $this->ask('UTM Campaign:');

            $this->info('Used for paid search. Use utm_term to note the keywords for this ad.');
            $utm['utm_term'] = $this->ask('UTM Term:');

            $this->info('Used for paid search. Use utm_term to note the keywords for this ad.');
            $utm['utm_content'] = $this->ask('UTM Content:');            

            $url .= (parse_url($url, PHP_URL_QUERY) ? '&' : '?') . http_build_query($utm);

        }

        return $this->info($url);

        $shortURLObject = $builder->destinationUrl($url);

        // if(request()->has('urlKey') && request()->input('urlKey')) {
        //     $shortURLObject = $shortURLObject->urlKey(request()->input('urlKey'));
        // }

        $shortURLObject = $shortURLObject->make();
        $shortURL = $shortURLObject;

        $this->table(
            ['ShortUrl', 'Destination', 'Single Use', 'Fwd Query Params', 'Track Visits', 'Redirect Code'],
            [
                [
                    'destination' => $shortURL->default_short_url, 
                    'default_short_url' => $shortURL->destination_url,
                    'single_use' => boolval($shortURL->single_use),
                    'forward_query_params' => boolval($shortURL->forward_query_params),
                    'track_visits' => boolval($shortURL->track_visits),
                    'redirect_status_code' => $shortURL->redirect_status_code,
                ]
            ]
        );

        $this->info($shortURL->default_short_url);
    }
}
