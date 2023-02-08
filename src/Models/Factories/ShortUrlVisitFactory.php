<?php

namespace JohnPaulMedina\ShortUrl\Models\Factories;

use JohnPaulMedina\ShortUrl\Models\ShortUrlVisit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

/**
 * @extends Factory<ShortURLVisit>
 */
class ShortUrlVisitFactory extends Factory
{
    protected $model = ShortUrlVisit::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'operating_system' => $this->faker->randomElement(
                array_keys(Agent::getPlatforms()),
            ),
            'operating_system_version' => $this->faker->randomFloat(8, 20),
            'browser' => $this->faker->randomElement(Agent::getBrowsers()),
            'browser_version' => $this->faker->userAgent(),
            'device_type' => $this->faker->randomElement(
                array_merge(
                    array_keys(Agent::getPhoneDevices()),
                    array_keys(Agent::getTabletDevices()),
                    array_keys(Agent::getDesktopDevices()),
                )),
            'visited_at' => Carbon::now(),
            'referer_url' => $this->faker->url(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
