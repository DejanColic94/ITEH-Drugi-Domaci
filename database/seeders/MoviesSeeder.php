<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movies;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Movies::factory()->count(10)->create();
    }
}
