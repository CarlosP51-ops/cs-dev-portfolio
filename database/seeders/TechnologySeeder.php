<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            ['name' => 'React', 'type' => 'frontend'],
            ['name' => 'Vue.js', 'type' => 'frontend'],
            ['name' => 'Angular', 'type' => 'frontend'],
            ['name' => 'Node.js', 'type' => 'backend'],
            ['name' => 'Express', 'type' => 'backend'],
            ['name' => 'Laravel', 'type' => 'backend'],
            ['name' => 'Django', 'type' => 'backend'],
            ['name' => 'MySQL', 'type' => 'database'],
            ['name' => 'PostgreSQL', 'type' => 'database'],
            ['name' => 'MongoDB', 'type' => 'database'],
        ];

        DB::table('technologies')->insert($technologies);
    }
}