<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'student_id',
        'date',
        'activity',
        'attachment',
        'mentor_feedback',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
