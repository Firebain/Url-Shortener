<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\ShortUrl;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)
        ->create([
            "email" => "admin@admin.com"
        ])
        ->each(function ($user) {
            $user->short_urls()->saveMany(
                factory(ShortUrl::class, 100)->create()
            );
        });
    }
}