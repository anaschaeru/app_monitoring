<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Company::insert([
            [
                'name' => 'PT Teknologi Nusantara',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
                'mentor_id' => 4, // ID Pembimbing Perusahaan
            ],
        ]);
    }
}
