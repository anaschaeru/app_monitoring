@extends('layouts.app')

@section('title', 'Tambah Absensi')

@section('content')
    <div class="container">
        <h1>Tambah Absensi</h1>
        <button id="checkInBtn" class="btn btn-primary">Check-in Sekarang</button>
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf

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
                <label for="location" class="form-label">Lokasi:</label>
                <input type="text" name="location_check_in" id="location" class="form-control" required readonly>
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

            <button type="submit" class="btn btn-primary">Simpan Absensi</button>
        </form>
    </div>
@endsection
