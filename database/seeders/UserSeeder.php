<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role 'Admin' sudah ada
        $adminRole = Role::firstOrCreate(['role_name' => 'Admin']);

        // Buat user admin
        User::create([
            'member_id' => 1,
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'role_id' => $adminRole->id,
        ]);

        // Tambahkan data user lain di sini jika diperlukan
    }
}
