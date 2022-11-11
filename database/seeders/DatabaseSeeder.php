<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Url;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Admin Default User',
             'email' => 'mint.dev@pm.me',
             'password' => Hash::make('password'),
         ]);

         Url::factory(20)->create();
    }
}
