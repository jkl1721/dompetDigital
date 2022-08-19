<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jackly Christanto Perdana',
            'username' => 'jkl1721',
            'password' => '$2y$10$QKBRP6hIZbj15es2pxC8SutYA3KfhsruGGoyGfTSUTBGrMscl4wQ6',
            'role' => 'Anak',
            'wallet' => 0
        ]);
        DB::table('users')->insert([
            'name' => 'Lukas Marcelino',
            'username' => 'llukas',
            'password' => '$2y$10$QKBRP6hIZbj15es2pxC8SutYA3KfhsruGGoyGfTSUTBGrMscl4wQ6',
            'role' => 'Bapak',
            'wallet' => 0
        ]);
    }
}
