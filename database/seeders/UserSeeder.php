<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'somissicarlos56@gmail.com'],
            [
                'name' => 'SOMISSI',
                'surname' => 'Carlos',
                'tel' => '0154181822',
                'password' => Hash::make('Carl229!'),
                'photo_de_profil' => null,
                'cv_path' => null,
                'facebook_link' => null,
                'github_link' => null,
                'linkedin_link' => null,
                'service' => null,
            ]
        );
    }
}
