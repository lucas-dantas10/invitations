<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Group;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $lucas = \App\Models\User::factory()->admin()->create([
            'name' => 'lucas',
            'email' => 'lucas@gmail.com'
        ]);
        
        $groups = Group::factory()->count(10)->create(['user_id' => $lucas->id]);

        foreach ($groups as $group) {
            $group->users()->attach($lucas);
        }
    }
}
