<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Adzwar Muhamad Fadhilah',
                'email' => 'siswa1@example.com',
                'password' => Hash::make('password'),
                'role' => 'siswa',
            ],
            [
                'name' => 'Pembimbing Sekolah',
                'email' => 'pembimbing_sekolah@example.com',
                'password' => Hash::make('password'),
                'role' => 'pembimbing_sekolah',
            ],
            [
                'name' => 'Pembimbing Perusahaan',
                'email' => 'pembimbing_perusahaan@example.com',
                'password' => Hash::make('password'),
                'role' => 'pembimbing_perusahaan',
            ],
        ]);
    }
}
