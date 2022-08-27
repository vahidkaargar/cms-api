<?php

namespace Database\Seeders;

use App\Models\Ability;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::insert([
            ['ability' => 'admin:super', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'admin:manager', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'post:store', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'post:update', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'post:destroy', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'category:store', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'category:update', 'created_at' => now(), 'updated_at' => now()],
            ['ability' => 'category:destroy', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
