<?php

use App\Models\ShortUrl;
use Illuminate\Database\Seeder;

class ShortUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ShortUrl::class, 100)->create();
    }
}
