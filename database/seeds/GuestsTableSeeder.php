<?php

use Illuminate\Database\Seeder;
use App\Models\Guest;

class GuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Guest::class, 10)->create()->each(function($guest) {
            $guest->make();
        });
    }
}
