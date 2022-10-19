<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\District;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call( DivisionSeeder::class );
        $this->call( DistrictSeeder::class );
        $this->call( UpazilaSeeder::class );
    }
}
