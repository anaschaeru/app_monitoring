@extends('layouts.app')

@section('title', 'Edit Absensi')

@section('content')
    <div class="container">
        <h1>Edit Absensi</h1>
        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="date" class="form-label">Tanggal:</label>
                <input type="date" name="date" class="form-control" value="{{ $attendance->date }}" readonly>
            </div>

            <div class="mb-3">
                <label for="check_in" class="form-label">Check-in:</label>
                <input type="time" name="check_in" class="form-control" value="{{ $attendance->check_in }}" readonly>
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Check-out:</label>
                <input type="time" name="check_out" class="form-control" value="{{ $attendance->check_out }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select name="status" class="form-control">
                    <option value="hadir" {{ $attendance->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="izin" {{ $attendance->status == 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="sakit" {{ $attendance->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ $attendance->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Koordinat Lokasi:</label>
                <input type="text" name="latitude" id="latitude" class="form-control"
                    value="{{ $attendance->latitude }}" readonly>
                <input type="text" name="longitude" id="longitude" class="form-control mt-2"
                    value="{{ $attendance->longitude }}" readonly>
                <button type="button" class="btn btn-info mt-2" id="getLocationBtn">Dapatkan Lokasi</button>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
