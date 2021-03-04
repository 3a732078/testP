<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = [
        'ta_id',
        'student_id',
        'course_id',
        'title',
        'content',
        'time',
        'response',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function ta()
    {
        return $this->belongsTo(Ta::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
