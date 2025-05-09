@extends('layouts.app')
@section('title', 'Students')
@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        @if (Auth::user()->role === 'admin')
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3>{{ $studentsCount }}</h3>
                            <p>Total Siswa PKL</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h3>{{ $reportsCount }}</h3>
                            <p>Total Laporan Kegiatan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h3>{{ $evaluationsCount }}</h3>
                            <p>Total Evaluasi</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(Auth::user()->role === 'siswa')
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h3>{{ $attendanceCount }}</h3>
                            <p>Jumlah Kehadiran</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-secondary text-white">
                        <div class="card-body">
                            <h3>{{ $reportsCount }}</h3>
                            <p>Jumlah Laporan Kegiatan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <h3>{{ $evaluation ? $evaluation->score : 'Belum Dinilai' }}</h3>
                            <p>Nilai Evaluasi Terakhir</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="text-center py-5">
        <h1>00:00</h1>
        <p>30 Mei 2024</p>
        <h2>Hallo, Rasyid Basir</h2>
        <p>PT. INDONESIA RAYA</p>
        <h3>ABSEN</h3>
        <div class="row mt-3">
            <div class="col">
                <button class="btn btn-primary btn-lg">Masuk</button>
            </div>
            <div class="col">
                <button class="btn btn-secondary btn-lg">Pulang</button>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card bg-success text-white mb-2">
            <div class="card-body">
                <h5 class="card-title">Pembimbing Sekolah</h5>
                <p class="card-text">Anas Chaerudin Maulana, S.Kom</p>
            </div>
        </div>
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Pembimbing Perusahaan</h5>
                <p class="card-text">Anas Chaerudin Maulana, S.Kom</p>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <h4>Riwayat Kehadiran</h4>
        <div class="list-group">
            <div class="list-group-item">
                <p>01/11/2025</p>
                <p>00:00 - 00:00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="list-group-item">
                <p>02/11/2025</p>
                <p>00:00 - 00:00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="list-group-item">
                <p>03/11/2025</p>
                <p>00:00 - 00:00</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
    </div>


@endsection
