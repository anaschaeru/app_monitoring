<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Report::insert([
            [
                'student_id' => 1, // ID Siswa
                'date' => now()->toDateString(),
                'activity' => 'Mengerjakan desain UI aplikasi perusahaan.',
                'attachment' => null,
                'mentor_feedback' => 'Bagus, lanjutkan!',
            ],
        ]);
    }
}
