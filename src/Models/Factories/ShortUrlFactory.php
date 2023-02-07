<?php

namespace JohnPaulMedina\ShortUrl\Models\Factories;

use JohnPaulMedina\ShortUrl\Classes\KeyGenerator;
use JohnPaulMedina\ShortUrl\Models\ShortUrl;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ShortUrl>
 */
class ShortUrlFactory extends Factory
{
    protected $model = ShortUrl::class;

    public function definition(): array
    {
        $urlKey = (new KeyGenerator())->generateRandom();

        return [
            'destination_url' => $this->faker->url(),
            'default_short_url' => url($urlKey),
            'url_key' => $urlKey,
            'single_use' => $this->faker->boolean(),
            'forward_query_params' => $this->faker->boolean(),
            'track_visits' => $this->faker->boolean(),
            'redirect_status_code' => $this->faker->randomElement([301, 302]),
            'track_ip_address' => $this->faker->boolean(),
            'track_operating_system' => $this->faker->boolean(),
            'track_operating_system_version' => $this->faker->boolean(),
            'track_browser' => $this->faker->boolean(),
            'track_browser_version' => $this->faker->boolean(),
            'track_referer_url' => $this->faker->boolean(),
            'track_device_type' => $this->faker->boolean(),
            'activated_at' => now(),
            'deactivated_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * @return ShortUrlFactory
     */
    public function deactivated(): ShortUrlFactory
    {
        return $this->state(function () {
            return [
                'deactivated_at' => now()->subDay(),
            ];
        });
    }

    /**
     * @return ShortUrlFactory
     */
    public function inactive(): ShortUrlFactory
    {
        return $this->state(function () {
            return [
                'activated_at' => null,
                'deactivated_at' => null,
            ];
        });
    }
}
