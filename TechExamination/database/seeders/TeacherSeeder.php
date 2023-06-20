<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\User;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'teacher@gmail.com', 
            'actor' => 1],
            [
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'actor'=>1,
            'password'=>bcrypt('12345678')
        ],);
    }
}
