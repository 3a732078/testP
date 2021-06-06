<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ta extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'course_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
