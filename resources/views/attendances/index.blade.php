@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
    <div class="container">
        <h1>Absensi Siswa PKL</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCheckIn">
            Check In
        </button>

        <!-- Modal Check In -->
        <div class="modal fade" id="modalCheckIn" tabindex="-1" aria-labelledby="modalCheckInLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalCheckInLabel">Absen Masuk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('attendances.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">

                            {{-- <div class="mb-3">
                <label for="date" class="form-label">Tanggal:</label>
                <input type="date" name="date" class="form-control" required>
            </div> --}}
                            {{--
            <div class="mb-3">
                <label for="check_in" class="form-label">Check-in:</label>
                <input type="time" name="check_in" value="{{ date('dd/mm/yyyy') }}" class="form-control" required>
            </div> --}}
                            <div class="mb-3">
                                <label for="location" class="form-label" hidden>Lokasi:</label>
                                <input type="text" name="location_check_in" id="location" class="form-control" required
                                    readonly>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <select name="status" class="form-control" required>
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alpha">Alpha</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Absen</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">Check In</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Kehadiran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
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
                                <a href="https://www.google.com/maps?q={{ $attendance->location_check_out }}"
                                    target="_blank" class="badge text-bg-primary text-decoration-none">
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
                                                                id="location_check_out" class="form-control" required
                                                                readonly>
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
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
