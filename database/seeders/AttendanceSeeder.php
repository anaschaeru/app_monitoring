<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Attendance::insert([
            [
                'student_id' => 1, // ID Siswa
                'date' => now()->toDateString(),
                'check_in' => '08:00:00',
                'check_out' => '16:00:00',
                'location_check_in' => '-6.18715206600443, 106.63777405209586',
                'location_check_out' => '-6.18715206600443, 106.63777405209586',
                'status' => 'hadir',
            ],
        ]);
    }
}
