<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.fr',
            'password' => bcrypt("azerty"),
            'email_verified_at' => now(),
            'role_id' => 2,
        ]);

        //create User
        User::create([
            'name' => 'user',
            'email' => 'user@test.fr',
            'password' => bcrypt("azerty"),
            'email_verified_at' => now(),
            'role_id' => 1,
        ]);
    }
}
