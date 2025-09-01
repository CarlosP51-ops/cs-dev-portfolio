<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'SOMISSI',
            'surname' => 'Carlos',
            'email' => 'carlosmahunan@gmail.com',
            'tel' => '0154181822',
            'password' => Hash::make('Carl229!'),
            'photo_de_profil' => null,
            'cv_path' => null,
            'facebook_link' => null,
            'github_link' => null,
            'linkedin_link' => null,
            'service' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
