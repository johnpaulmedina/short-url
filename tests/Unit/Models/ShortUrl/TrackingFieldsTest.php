<?php

namespace JohnPaulMedina\ShortUrl\Tests\Unit\Models\ShortUrl;

use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use JohnPaulMedina\ShortUrl\Tests\Unit\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackingFieldsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function array_is_returned_with_tracked_fields()
    {
        $shortURL = ShortUrl::create([
            'destination_url'                => 'https://google.com',
            'default_short_url'              => config('short-url.default_url').'/short/12345',
            'url_key'                        => '12345',
            'single_use'                     => true,
            'track_visits'                   => true,
            'redirect_status_code'           => 301,
            'track_ip_address'               => true,
            'track_operating_system'         => true,
            'track_operating_system_version' => false,
            'track_browser'                  => true,
            'track_browser_version'          => true,
            'track_referer_url'              => false,
            'track_device_type'              => true,
        ]);

        $this->assertSame([
            'ip_address',
            'operating_system',
            'browser',
            'browser_version',
            'device_type',
        ], $shortURL->trackingFields());
    }

    /** @test */
    public function empty_array_is_returned_if_no_fields_are_set_to_be_tracked()
    {
        $shortURL = ShortUrl::create([
            'destination_url'                => 'https://google.com',
            'default_short_url'              => config('short-url.default_url').'/short/12345',
            'url_key'                        => '12345',
            'single_use'                     => true,
            'track_visits'                   => true,
            'redirect_status_code'           => 301,
            'track_ip_address'               => false,
            'track_operating_system'         => false,
            'track_operating_system_version' => false,
            'track_browser'                  => false,
            'track_browser_version'          => false,
            'track_referer_url'              => false,
            'track_device_type'              => false,
        ]);

        $this->assertSame([], $shortURL->trackingFields());
    }
}
