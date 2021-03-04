<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Textbook extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'name',
        'path',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
