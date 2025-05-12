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
        <h1 id="currentTime"></h1>

        <p>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</p>
        <h2>Hallo, {{ Auth::user()->name }}</h2>
        <p>
            {{ Auth::user()->student->company->name }}


        </p>
        <h3>ABSEN</h3>
        <div class="row mt-3">
            <h1>Dashboard Siswa PKL</h1>

            <button id="checkInBtn" class="btn btn-primary">Check-in Sekarang</button>
            <button id="checkOutBtn" class="btn btn-danger">Check-out Sekarang</button>


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
        @foreach ($attendances as $attendance)
            <div class="border border-1 p-3 mb-3 rounded">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">
                        {{ $attendance->date }}

                    </h5>
                    <small>{!! $attendance->status === 'hadir'
                        ? '<i class="bi bi-calendar2-check text-success"></i>'
                        : ($attendance->status === 'sakit'
                            ? '<i class="bi bi-calendar2-heart text-danger"></i>'
                            : ($attendance->status === 'izin'
                                ? '<i class="bi bi-calendar2-minus text-danger"></i>'
                                : '<i class="bi bi-calendar2-x text-danger"></i>')) !!}
                    </small>
                </div>
                <p class="mb-1">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel, soluta beatae. Error
                    consequatur illo soluta.</p>
                <small>
                    @if ($attendance->location_check_in == true)
                        <a href="https://www.google.com/maps?q={{ $attendance->location_check_in }}" target="_blank"
                            class="badge text-bg-info text-decoration-none">
                            <i class="bi bi-geo-alt"></i> Check In
                        </a>
                        <span class="badge text-bg-info text-decoration-none">
                            <i class="bi bi-clock"></i> {{ $attendance->check_in }}
                        </span>
                    @endif
                    @if ($attendance->location_check_out == true)
                        <a href="https://www.google.com/maps?q={{ $attendance->location_check_out }}" target="_blank"
                            role="text" class="badge text-bg-primary text-decoration-none">
                            <i class="bi bi-geo-alt"></i> Check Out
                        </a>
                        <span class="badge text-bg-primary text-decoration-none">
                            <i class="bi bi-clock"></i> {{ $attendance->check_out }}
                        </span>
                    @endif
                </small>
                {{-- <div class="">

                        @if ($attendance->location_check_in == true)
                            <a href="https://www.google.com/maps?q={{ $attendance->location_check_in }}" target="_blank"
                                class="badge text-bg-info text-decoration-none">
                                <i class="bi bi-geo-alt"></i> Check In
                            </a>
                            <span class="badge text-bg-info text-decoration-none">
                                <i class="bi bi-clock"></i> {{ $attendance->check_in }}
                            </span>
                        @endif
                        @if ($attendance->location_check_out == true)
                            <br>
                            <a href="https://www.google.com/maps?q={{ $attendance->location_check_out }}" target="_blank"
                                class="badge text-bg-primary text-decoration-none">
                                <i class="bi bi-geo-alt"></i> Check Out
                            </a>
                            <span class="badge text-bg-primary text-decoration-none">
                                <i class="bi bi-clock"></i> {{ $attendance->check_out }}
                            </span>
                        @endif
                    </div> --}}
            </div>
        @endforeach
    </div>
    {{-- @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->date }}
                        {!! $attendance->status === 'hadir'
                            ? '<i class="bi bi-calendar2-check text-success"></i>'
                            : ($attendance->status === 'sakit'
                                ? '<i class="bi bi-calendar2-heart text-danger"></i>'
                                : ($attendance->status === 'izin'
                                    ? '<i class="bi bi-calendar2-minus text-danger"></i>'
                                    : '<i class="bi bi-calendar2-x text-danger"></i>')) !!}
                        <br>
                        @if ($attendance->location_check_in == true)
                            <a href="https://www.google.com/maps?q={{ $attendance->location_check_in }}" target="_blank"
                                class="badge text-bg-info text-decoration-none">
                                <i class="bi bi-geo-alt"></i> Check In
                            </a>
                            <span class="badge text-bg-info text-decoration-none">
                                <i class="bi bi-clock"></i> {{ $attendance->check_in }}
                            </span>
                        @endif
                        @if ($attendance->location_check_out == true)
                            <br>
                            <a href="https://www.google.com/maps?q={{ $attendance->location_check_out }}" target="_blank"
                                class="badge text-bg-primary text-decoration-none">
                                <i class="bi bi-geo-alt"></i> Check Out
                            </a>
                            <span class="badge text-bg-primary text-decoration-none">
                                <i class="bi bi-clock"></i> {{ $attendance->check_out }}
                            </span>
                        @endif
                    </td>
                    <td>{{ ucfirst($attendance->status) }}</td>
                    <td>
                        <a href="{{ route('attendances.show', $attendance->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                        @if (!$attendance->check_out && Auth::user()->role === 'siswa')
                            <form action="{{ route('attendances.checkout', $attendance->id) }}" method="POST"
                                style="display:inline;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalCheckOut">
                                    Check Out
                                </button>
                                <!-- Modal Check Out -->
                                <div class="modal fade" id="modalCheckOut" tabindex="-1"
                                    aria-labelledby="modalCheckOutLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="modalCheckOutLabel">Absen Masuk</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('attendances.checkout', $attendance->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="location" class="form-label" hidden>Lokasi:</label>
                                                        <input type="text" name="location_check_out"
                                                            id="location_check_out" class="form-control" required readonly>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Absen</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </td>
                </tr>
            @endforeach --}}
    </div>
@endsection
