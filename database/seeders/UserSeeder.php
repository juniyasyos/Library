<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Pastikan role 'Admin' sudah ada
        $adminRole = Role::firstOrCreate(['role_name' => 'Admin']);
        $memberRole = Role::firstOrCreate(['role_name' => 'Member']);

        // Buat user admin
        User::create([
            'member_id' => 1,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('HelloWorld123!@#'),
            'role_id' => $adminRole->id,
        ]);

        // Buat 19 user dengan role 'Member'
        for ($i = 2; $i <= 100; $i++) {
            User::create([
                'member_id' => $i,
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Password default: 'password'
                'role_id' => $memberRole->id,
            ]);
        }
    }
}
