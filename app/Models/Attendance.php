<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'check_in',
        'check_out',
        'location_check_in',
        'location_check_out',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
