<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'content',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
