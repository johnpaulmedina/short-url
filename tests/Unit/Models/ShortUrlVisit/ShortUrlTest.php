<?php

namespace JohnPaulMedina\ShortUrl\Tests\Unit\Models\ShortUrlVisit;

use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use JohnPaulMedina\ShortUrl\Models\ShortURLVisit;
use JohnPaulMedina\ShortUrl\Tests\Unit\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

class ShortUrlTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @test */
    public function short_url_can_be_fetched_from_visit(): void
    {
        $shortURL = ShortUrl::create([
            'destination_url'   => 'https://example.com',
            'default_short_url' => 'https://domain.com/12345',
            'url_key'           => '12345',
            'single_use'        => true,
            'track_visits'      => true,
        ]);

        /** @var ShortURLVisit $visit */
        $visit = ShortURLVisit::create(['short_url_id' => $shortURL->id, 'visited_at' => now()]);

        $this->assertTrue($visit->shortURL->is($shortURL));
    }
}
