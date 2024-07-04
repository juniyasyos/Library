<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        Member::create([
            'full_name' => 'Ahmad Ilyas',
            'department_id' => 15,
            'phone_number' => '085732431396',
            'address' => 'tekotok',
            'join_date' => $faker->date
        ]);

        for ($i = 1; $i < 100; $i++) {
            Member::create([
                'full_name' => $faker->name,
                'department_id' => $faker->numberBetween(1, 84),
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'join_date' => $faker->date
            ]);
        }
    }
}
