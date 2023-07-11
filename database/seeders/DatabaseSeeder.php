<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         Topic::factory()->create([
            'user_id' => User::all()->shuffle()->first()->id,
            'classroom_id' => Classroom::all()->first()->id,
        ]);
        
    }
}
