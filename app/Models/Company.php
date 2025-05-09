<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'mentor_id',
    ];

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
