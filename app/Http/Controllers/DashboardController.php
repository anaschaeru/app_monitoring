<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $studentsCount = Student::count();
            $reportsCount = Report::count();
            $evaluationsCount = Evaluation::count();
            return view('dashboard.index', compact('studentsCount', 'reportsCount', 'evaluationsCount'));
        }

        if ($user->role === 'siswa') {
            $student = $user->student;
            $attendanceCount = Attendance::where('student_id', $student->id)->count();
            $reportsCount = Report::where('student_id', $student->id)->count();
            $evaluation = Evaluation::where('student_id', $student->id)->latest()->first();
            return view('dashboard.index', compact('attendanceCount', 'reportsCount', 'evaluation'));
        }

        return redirect()->route('home');
    }
}
