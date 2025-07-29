<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'franklinroswer@gmail.com'],
            [
                'name' => 'franklin',
                'role' => 'admin',
                'dob' => '2000-10-10',
                'password' => Hash::make('12345678'),
                'email_verified_at' => '2022-01-02 17:04:58',
            ]
        );
    }
}
