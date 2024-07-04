<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            ['faculty_name' => 'Fakultas Hukum'],
            ['faculty_name' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['faculty_name' => 'Fakultas Pertanian'],
            ['faculty_name' => 'Fakultas Ekonomi dan Bisnis'],
            ['faculty_name' => 'Fakultas Keguruan dan Ilmu Pendidikan'],
            ['faculty_name' => 'Fakultas Ilmu Budaya'],
            ['faculty_name' => 'Fakultas Teknologi Pertanian'],
            ['faculty_name' => 'Fakultas Teknik'],
            ['faculty_name' => 'Fakultas Kedokteran'],
            ['faculty_name' => 'Fakultas Kedokteran Gigi'],
            ['faculty_name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['faculty_name' => 'Fakultas Kesehatan Masyarakat'],
            ['faculty_name' => 'Fakultas Farmasi'],
            ['faculty_name' => 'Fakultas Keperawatan'],
            ['faculty_name' => 'Fakultas Ilmu Komputer']
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }
    }
}
