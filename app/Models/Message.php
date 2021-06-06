<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'TA_id',
        'content',
    ];

    public function TA(){
        return $this->belongsTo(TA::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
