<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'note_id',
        'content',
        'time',
        'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function response()
    {
        return $this->belongsTo(Comment::class);
    }
}
