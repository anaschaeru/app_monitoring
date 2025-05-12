<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    //
    /**
     * Menampilkan dashboard siswa.
     */
    public function index()
    {
        $student = Auth::user()->student;
        $attendances = Attendance::where('student_id', $student->id)->latest()->get();

        return view('students.dashboard', compact('attendances'));
    }
}
