@extends('layouts.app')

@section('title', 'Dashboard')

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
@endsection
