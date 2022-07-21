<?php

namespace Database\Factories;

use App\Services\ShortLinkService;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShortLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $url = url('/') . '/' . $this->faker->userName();
        return [
            'url' => $url,
            'short' => (new ShortLinkService())->generateShortPart($url),
        ];
    }
}
