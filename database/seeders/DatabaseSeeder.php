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
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Admin Default User',
             'email' => 'mint.dev@pm.me',
             'password' => Hash::make('password'),
             'is_superadmin' => true,
         ]);

         User::factory(5)->create();

         Url::factory(200)->create();

         UrlCall::factory(2000)->create();
    }
}
