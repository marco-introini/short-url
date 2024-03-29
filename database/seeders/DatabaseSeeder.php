<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Url;
use App\Models\UrlCall;
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
         User::factory()->create([
             'name' => 'Admin Default User',
             'email' => 'admin@example.com',
             'password' => Hash::make('password'),
             'is_superadmin' => true,
         ]);

        User::factory()->create([
            'name' => 'Default User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_superadmin' => false,
        ]);

         User::factory(5)->create();

         Url::factory(200)->create();

         UrlCall::factory(2000)->create();
    }
}
