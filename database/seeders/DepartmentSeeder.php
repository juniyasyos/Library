<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            // Fakultas Hukum (FH)
            ['department_name' => 'Ilmu Hukum', 'faculty_id' => 1], // S1, mempelajari dasar-dasar hukum, perundang-undangan, dan sistem hukum di Indonesia
            ['department_name' => 'Kenotariatan', 'faculty_id' => 1], // S1, membekali mahasiswa untuk menjadi notaris yang profesional
            ['department_name' => 'Magister Ilmu Hukum', 'faculty_id' => 1], // S2, memperdalam pengetahuan hukum dengan spesialisasi tertentu
            ['department_name' => 'Doktor Ilmu Hukum', 'faculty_id' => 1], // S3, menghasilkan peneliti dan ahli hukum yang berkualitas

            // Fakultas Ilmu Sosial dan Ilmu Politik (FISIP)
            ['department_name' => 'Ilmu Administrasi Negara', 'faculty_id' => 2], // S1, mempelajari administrasi publik, kebijakan publik, dan manajemen pemerintahan
            ['department_name' => 'Ilmu Administrasi Bisnis', 'faculty_id' => 2], // S1, mempelajari administrasi dan manajemen di sektor bisnis
            ['department_name' => 'Ilmu Pemerintahan', 'faculty_id' => 2], // S1, mempelajari sistem pemerintahan, politik, dan kebijakan publik
            ['department_name' => 'Sosiologi', 'faculty_id' => 2], // S1, mempelajari masyarakat, interaksi sosial, dan perubahan sosial
            ['department_name' => 'Ilmu Komunikasi', 'faculty_id' => 2], // S1, mempelajari komunikasi massa, komunikasi interpersonal, dan komunikasi organisasi
            ['department_name' => 'Hubungan Internasional', 'faculty_id' => 2], // S1, mempelajari hubungan antarnegara, diplomasi, dan isu-isu global
            ['department_name' => 'Kesejahteraan Sosial', 'faculty_id' => 2], // S1, mempelajari masalah sosial, kebijakan sosial, dan intervensi sosial
            ['department_name' => 'Magister Ilmu Administrasi', 'faculty_id' => 2], // S2, memperdalam pengetahuan administrasi publik dan bisnis
            ['department_name' => 'Magister Sosiologi', 'faculty_id' => 2], // S2, memperdalam pengetahuan sosiologi dengan fokus penelitian tertentu
            ['department_name' => 'Doktor Ilmu Sosial', 'faculty_id' => 2], // S3, menghasilkan peneliti dan ahli ilmu sosial yang berkualitas

            // Fakultas Pertanian (FAPERTA)
            ['department_name' => 'Agroteknologi', 'faculty_id' => 3], // S1, mempelajari teknologi budidaya tanaman, pengelolaan tanah, dan pengendalian hama penyakit
            ['department_name' => 'Agribisnis', 'faculty_id' => 3], // S1, mempelajari bisnis pertanian, pemasaran hasil pertanian, dan manajemen agribisnis
            ['department_name' => 'Peternakan', 'faculty_id' => 3], // S1, mempelajari produksi ternak, kesehatan hewan, dan manajemen peternakan
            ['department_name' => 'Teknologi Hasil Pertanian', 'faculty_id' => 3], // S1, mempelajari pengolahan dan pengawetan hasil pertanian
            ['department_name' => 'Ilmu Tanah', 'faculty_id' => 3], // S1, mempelajari sifat, klasifikasi, dan pengelolaan tanah
            ['department_name' => 'Agronomi', 'faculty_id' => 3], // S1, mempelajari budidaya tanaman pangan, hortikultura, dan tanaman industri
            ['department_name' => 'Proteksi Tanaman', 'faculty_id' => 3], // S1, mempelajari pengendalian hama dan penyakit tanaman
            ['department_name' => 'Hama dan Penyakit Tanaman', 'faculty_id' => 3], // S1, mempelajari biologi dan ekologi hama dan penyakit tanaman
            ['department_name' => 'Sosial Ekonomi Pertanian', 'faculty_id' => 3], // S1, mempelajari aspek sosial dan ekonomi dalam pertanian
            ['department_name' => 'Budidaya Perairan', 'faculty_id' => 3], // S1, mempelajari budidaya ikan, udang, dan organisme perairan lainnya
            ['department_name' => 'Magister Agronomi', 'faculty_id' => 3], // S2, memperdalam pengetahuan agronomi dengan fokus penelitian tertentu
            ['department_name' => 'Magister Ilmu Tanah', 'faculty_id' => 3], // S2, memperdalam pengetahuan ilmu tanah dengan fokus penelitian tertentu
            ['department_name' => 'Magister Agribisnis', 'faculty_id' => 3], // S2, memperdalam pengetahuan agribisnis dengan fokus penelitian tertentu
            ['department_name' => 'Magister Peternakan', 'faculty_id' => 3], // S2, memperdalam pengetahuan peternakan dengan fokus penelitian tertentu
            ['department_name' => 'Magister Budidaya Perairan', 'faculty_id' => 3], // S2, memperdalam pengetahuan budidaya perairan dengan fokus penelitian tertentu
            ['department_name' => 'Doktor Ilmu Pertanian', 'faculty_id' => 3], // S3, menghasilkan peneliti dan ahli pertanian yang berkualitas

            // Fakultas Ekonomi dan Bisnis (FEB)
            ['department_name' => 'Manajemen', 'faculty_id' => 4], // S1, mempelajari manajemen sumber daya manusia, pemasaran, keuangan, dan operasi
            ['department_name' => 'Akuntansi', 'faculty_id' => 4], // S1, mempelajari akuntansi keuangan, akuntansi manajemen, auditing, dan perpajakan
            ['department_name' => 'Ilmu Ekonomi', 'faculty_id' => 4], // S1, mempelajari teori ekonomi mikro dan makro, ekonomi pembangunan, dan ekonomi moneter
            ['department_name' => 'Ilmu Ekonomi Islam', 'faculty_id' => 4], // S1, mempelajari ekonomi Islam, keuangan Islam, dan perbankan Islam
            ['department_name' => 'Ekonomi Pembangunan', 'faculty_id' => 4], // S1, mempelajari pembangunan ekonomi, perencanaan pembangunan, dan kebijakan ekonomi
            ['department_name' => 'Magister Manajemen', 'faculty_id' => 4], // S2, memperdalam pengetahuan manajemen dengan spesialisasi tertentu
            ['department_name' => 'Magister Akuntansi', 'faculty_id' => 4], // S2, memperdalam pengetahuan akuntansi dengan spesialisasi tertentu
            ['department_name' => 'Magister Ilmu Ekonomi', 'faculty_id' => 4], // S2, memperdalam pengetahuan ilmu ekonomi dengan fokus penelitian tertentu
            ['department_name' => 'Magister Ekonomi Pembangunan', 'faculty_id' => 4], // S2, memperdalam pengetahuan ekonomi pembangunan dengan fokus penelitian tertentu
            ['department_name' => 'Doktor Ilmu Ekonomi', 'faculty_id' => 4], // S3, menghasilkan peneliti dan ahli ekonomi yang berkualitas

            // Fakultas Keguruan dan Ilmu Pendidikan (FKIP)
            ['department_name' => 'Pendidikan Bahasa dan Sastra Indonesia', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Bahasa Inggris', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Matematika', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Biologi', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Fisika', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Kimia', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Ekonomi', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Sejarah', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Geografi', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Guru Sekolah Dasar', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Pancasila dan Kewarganegaraan', 'faculty_id' => 5],
            ['department_name' => 'Bimbingan dan Konseling', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Luar Sekolah', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Jasmani Kesehatan dan Rekreasi', 'faculty_id' => 5],
            ['department_name' => 'Pendidikan Seni Drama Tari dan Musik', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan Bahasa Indonesia', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan Bahasa Inggris', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan Matematika', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan IPA','faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan IPS', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan Dasar', 'faculty_id' => 5],
            ['department_name' => 'Magister Bimbingan dan Konseling', 'faculty_id' => 5],
            ['department_name' => 'Magister Pendidikan Luar Sekolah', 'faculty_id' => 5],
            ['department_name' => 'Doktor Ilmu Pendidikan', 'faculty_id' => 5],

            // Fakultas Ilmu Budaya (FIB)
            ['department_name' => 'Sastra Indonesia', 'faculty_id' => 6],
            ['department_name' => 'Sastra Inggris', 'faculty_id' => 6],
            ['department_name' => 'Sejarah', 'faculty_id' => 6],
            ['department_name' => 'Ilmu Keislaman', 'faculty_id' => 6],
            ['department_name' => 'Magister Ilmu Sejarah', 'faculty_id' => 6],
            ['department_name' => 'Magister Sastra Indonesia', 'faculty_id' => 6],
            ['department_name' => 'Magister Pendidikan Bahasa Inggris', 'faculty_id' => 6],

            // Fakultas Teknologi Pertanian (FTP)
            ['department_name' => 'Teknologi Industri Pertanian', 'faculty_id' => 7], // S1
            ['department_name' => 'Teknik Pertanian', 'faculty_id' => 7], // S1
            ['department_name' => 'Bioteknologi', 'faculty_id' => 7], // S1
            ['department_name' => 'Ilmu dan Teknologi Pangan', 'faculty_id' => 7], // S1
            ['department_name' => 'Teknologi Hasil Perkebunan', 'faculty_id' => 7], // S1, mempelajari pengolahan dan teknologi produk perkebunan
            ['department_name' => 'Magister Teknologi Industri Pertanian', 'faculty_id' => 7], // S2
            ['department_name' => 'Magister Teknik Pertanian', 'faculty_id' => 7], // S2
            ['department_name' => 'Magister Bioteknologi', 'faculty_id' => 7], // S2
            ['department_name' => 'Doktor Ilmu Teknologi Pertanian', 'faculty_id' => 7], // S3

            // Fakultas Teknik (FT)
            ['department_name' => 'Teknik Sipil', 'faculty_id' => 8], // S1
            ['department_name' => 'Teknik Mesin', 'faculty_id' => 8], // S1
            ['department_name' => 'Teknik Elektro', 'faculty_id' => 8], // S1
            ['department_name' => 'Arsitektur', 'faculty_id' => 8], // S1
            ['department_name' => 'Teknik Kimia', 'faculty_id' => 8], // S1
            ['department_name' => 'Magister Teknik Sipil', 'faculty_id' => 8], // S2
            ['department_name' => 'Magister Teknik Elektro', 'faculty_id' => 8], // S2
            ['department_name' => 'Magister Teknik Mesin', 'faculty_id' => 8], // S2
            ['department_name' => 'Magister Teknik Kimia', 'faculty_id' => 8], // S2
            ['department_name' => 'Doktor Ilmu Teknik', 'faculty_id' => 8], // S3

            // Fakultas Kedokteran (FK)
            ['department_name' => 'Pendidikan Dokter', 'faculty_id' => 9], // S1
            ['department_name' => 'Pendidikan Dokter Spesialis', 'faculty_id' => 9], // Spesialis

            // Fakultas Kedokteran Gigi (FKG)
            ['department_name' => 'Pendidikan Dokter Gigi', 'faculty_id' => 10], // S1
            ['department_name' => 'Pendidikan Dokter Gigi Spesialis', 'faculty_id' => 10], // Spesialis

            // Fakultas Matematika dan Ilmu Pengetahuan Alam (FMIPA)
            ['department_name' => 'Matematika', 'faculty_id' => 11], // S1
            ['department_name' => 'Fisika', 'faculty_id' => 11], // S1
            ['department_name' => 'Kimia', 'faculty_id' => 11], // S1
            ['department_name' => 'Biologi', 'faculty_id' => 11], // S1
            ['department_name' => 'Statistika', 'faculty_id' => 11], // S1
            ['department_name' => 'Sistem Informasi Geografis', 'faculty_id' => 11], // S1
            ['department_name' => 'Magister Matematika', 'faculty_id' => 11], // S2
            ['department_name' => 'Magister Fisika', 'faculty_id' => 11], // S2
            ['department_name' => 'Magister Kimia', 'faculty_id' => 11], // S2
            ['department_name' => 'Magister Biologi', 'faculty_id' => 11], // S2
            ['department_name' => 'Magister Statistika', 'faculty_id' => 11], // S2
            ['department_name' => 'Doktor Ilmu Matematika dan Ilmu Pengetahuan Alam', 'faculty_id' => 11], // S3

            // Fakultas Kesehatan Masyarakat (FKM)
            ['department_name' => 'Kesehatan Masyarakat', 'faculty_id' => 12], // S1
            ['department_name' => 'Gizi', 'faculty_id' => 12], // S1
            ['department_name' => 'Magister Kesehatan Masyarakat', 'faculty_id' => 12], // S2
            ['department_name' => 'Magister Gizi', 'faculty_id' => 12], // S2
            ['department_name' => 'Doktor Ilmu Kesehatan Masyarakat', 'faculty_id' => 12], // S3

            // Fakultas Farmasi (FF)
            ['department_name' => 'Farmasi', 'faculty_id' => 13], // S1
            ['department_name' => 'Farmasi Klinis', 'faculty_id' => 13], // Profesi
            ['department_name' => 'Magister Farmasi', 'faculty_id' => 13], // S2
            ['department_name' => 'Doktor Ilmu Farmasi', 'faculty_id' => 13], // S3

            // Fakultas Keperawatan (FKep)
            ['department_name' => 'Keperawatan', 'faculty_id' => 14], // S1
            ['department_name' => 'Profesi Ners', 'faculty_id' => 14], // Profesi
            ['department_name' => 'Magister Keperawatan', 'faculty_id' => 14], // S2

            // Fakultas Ilmu Komputer (Fasilkom)
            ['department_name' => 'Sistem Informasi', 'faculty_id' => 15], // S1
            ['department_name' => 'Teknik Informasi', 'faculty_id' => 15], // S1
            ['department_name' => 'Informatika', 'faculty_id' => 15], // S1
            ['department_name' => 'Magister Sistem Informasi', 'faculty_id' => 15], // S2
            ['department_name' => 'Magister Informatika', 'faculty_id' => 15], // S2
        ];


        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
