<?php

namespace Database\Seeders;

use App\Models\ShortLink;
use Illuminate\Database\Seeder;

class ShortLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShortLink::factory(10)->create();
    }
}
