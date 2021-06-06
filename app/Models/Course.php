<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'grade',
        'classroom',
        'year',
        'semester',
    ];

    public function textbooks()
    {
        return $this->hasMany(Textbook::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class,'course_students');
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function student_ta()
    {
        return $this->belongsToMany(Student::class,'tas');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
