<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Student::insert([
            [
                'user_id' => 3, // ID User Siswa
                'school' => 'SMK Negeri 1',
                'company_id' => 1, // ID Perusahaan
            ],
        ]);
    }
}
