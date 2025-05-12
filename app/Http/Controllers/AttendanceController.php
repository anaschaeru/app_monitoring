<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Attendance;
use App\Models\Evaluation;
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

        $student = $user->student;
        $attendanceCount = Attendance::where('student_id', $student->id)->count();
        $reportsCount = Report::where('student_id', $student->id)->count();
        $evaluation = Evaluation::where('student_id', $student->id)->latest()->first();

        return view('students.index', compact('attendances', 'attendanceCount', 'reportsCount', 'evaluation'));
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
        // return view('attendances.show', compact('attendance'));
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

    public function checkIn(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $student = Auth::user()->student;

        // Cek apakah sudah check-in hari ini
        $existingAttendance = Attendance::where('student_id', $student->id)
            ->where('date', now()->toDateString())
            ->first();

        if ($existingAttendance) {
            return response()->json(['message' => 'Anda sudah melakukan check-in hari ini.'], 400);
        }

        Attendance::create([
            'student_id' => $student->id,
            'date' => now()->toDateString(),
            'check_in' => now()->format('H:i'),
            'location_check_in' => $request->latitude . ', ' . $request->longitude,
            'check_out' => null,
            'location_check_out' => null,
            'status' => 'hadir',
        ]);

        return response()->json(['message' => 'Check-in berhasil dilakukan!']);
    }

    /**
     * Proses check-out siswa dengan lokasi.
     */
    public function checkOut(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $student = Auth::user()->student;

        // Cari absensi hari ini berdasarkan student_id
        $attendance = Attendance::where('student_id', $student->id)
            ->where('date', now()->toDateString())
            ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Anda belum melakukan check-in hari ini.'], 400);
        }

        if ($attendance->check_out) {
            return response()->json(['message' => 'Anda sudah melakukan check-out hari ini.'], 400);
        }

        $attendance->update([
            'check_out' => now()->format('H:i'),
            'location_check_out' => $request->latitude . ', ' . $request->longitude,
        ]);

        return response()->json(['message' => 'Check-out berhasil dilakukan!']);
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
