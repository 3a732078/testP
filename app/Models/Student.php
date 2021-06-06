<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_students');
    }

    public function ta()
    {
        return $this->hasOne(Ta::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
