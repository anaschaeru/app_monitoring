<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Evaluation::insert([
            [
                'student_id' => 1, // ID Siswa
                'mentor_id' => 4, // ID Pembimbing Perusahaan
                'score' => 85,
                'comments' => 'Siswa sangat rajin dan cepat belajar.',
            ],
        ]);
    }
}
