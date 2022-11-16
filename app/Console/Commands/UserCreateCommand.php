<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserCreateCommand extends Command
{
    protected $signature = 'user:create';

    protected $description = 'Create a new user';

    public function handle()
    {
        $name = $this->ask('What is the user name?');

        $email = $this->ask('What is the user email?');

        $password = $this->ask('What is the user password?');

        $isAdmin = $this->ask('Is this user a super admin? (y/N)');
        $admin = false;

        if (Str::upper($isAdmin) !== 'Y') {
            $admin = true;
        }

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->info('User not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_superadmin' => $admin
        ])->save();

        $this->info("User created!");

        return 0;

    }
}
