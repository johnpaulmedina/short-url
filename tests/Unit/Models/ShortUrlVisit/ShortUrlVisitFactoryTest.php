<?php

namespace JohnPaulMedina\ShortUrl\Tests\Unit\Models\ShortUrlVisit;

use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use JohnPaulMedina\ShortUrl\Models\ShortURLVisit;
use JohnPaulMedina\ShortUrl\Tests\Unit\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShortUrlVisitFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_that_short_url_visit_model_factory_works_fine(): void
    {
        $shortURL = ShortUrl::factory()->create();

        $shortURLVisit = ShortURLVisit::factory()->for($shortURL)->create();

        $this->assertDatabaseCount('short_url_visits', 1)
            ->assertDatabaseCount('short_urls', 1)
            ->assertModelExists($shortURLVisit)
            ->assertModelExists($shortURL);

        $this->assertTrue($shortURLVisit->shortURL->is($shortURL));
    }
}
