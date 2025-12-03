<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'alea@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('alea123'),
                'role' => 'admin',
            ]
        );
    }
}


