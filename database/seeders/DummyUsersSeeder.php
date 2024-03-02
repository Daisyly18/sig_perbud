<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'=> 'Admin',
            'role'=>'Admin',
            'email'=> 'admin@localhost',
            'email_verified_at' => now(),
            'password'=>bcrypt('admin123')
        ]);        
    }
}
