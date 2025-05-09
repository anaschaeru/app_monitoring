<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        if ($user->role === 'siswa') {
            $attendances = Attendance::where('student_id', $user->student->id)->latest()->get();
        } else {
            $attendances = Attendance::latest()->get();
        }

        return view('attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('attendances.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'location_check_in' => 'required|string|max:255',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create([
            'student_id' => Auth::user()->student->id,
            'date' => now()->format('Y-m-d'),
            'check_in' => now()->format('H:i'),
            'check_out' => null, // Check-out bisa diupdate nanti
            'location_check_in' => $request->location_check_in,
            'location_check_out' => $request->location_check_out,
            'status' => $request->status,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $attendance)
    {
        //
        return view('attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $attendance)
    {
        //
        $attendance = Attendance::findOrFail($attendance);
        return view('attendances.edit', compact('attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        // Validasi input
        {
            //
            $request->validate([
                'check_out' => 'nullable|date_format:H:i',
                'status' => 'required|in:hadir,izin,sakit,alpha',
            ]);

            $attendance->update([
                'check_out' => $request->check_out,
                'status' => $request->status,
            ]);

            return redirect()->route('attendances.index')->with('success', 'Absensi berhasil diperbarui.');
        }
    }

    /**
     * Proses check-out siswa.
     */
    public function checkout(Request $request, Attendance $attendance)
    {
        // Pastikan hanya siswa yang bisa check-out dirinya sendiri
        if (Auth::user()->role !== 'siswa' || Auth::user()->student->id !== $attendance->student_id) {
            return redirect()->route('attendances.index')->withErrors(['access' => 'Anda tidak memiliki izin untuk check-out.']);
        }

        // Pastikan siswa belum check-out
        if ($attendance->check_out) {
            return redirect()->route('attendances.index')->withErrors(['checkout' => 'Anda sudah melakukan check-out hari ini.']);
        }

        // Update waktu check-out
        $attendance->update([
            'check_out' => now()->format('H:i'),
            'location_check_out' => $request->location_check_out,
        ]);

        return redirect()->route('attendances.index')->with('success', 'Check-out berhasil dilakukan.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $attendance)
    {
        //
        $attendance = Attendance::findOrFail($attendance);
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil dihapus.');
    }
}
