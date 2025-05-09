<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluation extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'score',
        'comments',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
