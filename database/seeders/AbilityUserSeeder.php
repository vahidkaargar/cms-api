<?php

namespace Database\Seeders;

use App\Models\AbilityUser;
use Illuminate\Database\Seeder;

class AbilityUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbilityUser::insert([
            ['user_id' => 1, 'ability_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'ability_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'ability_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'ability_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'ability_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'ability_id' => 7, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
