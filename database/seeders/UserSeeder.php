<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@mail.ru',
            'role' => UserRoleEnum::ADMIN,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@mail.ru',
            'role' => UserRoleEnum::NORMAL,
            'password' => Hash::make('password'),
        ]);
    }
}
