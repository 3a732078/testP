<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'textbook_id',
        'title',
        'attach',
        'time',
        'page',
        'share',
        'like',
        'textfile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function collects()
    {
        return $this->belongsToMany(User::class,'collect_notes');
    }

    public function scores()
    {
        return $this->belongsToMany(User::class,'note_scores');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function textbook()
    {
        return $this->belongsTo(Textbook::class);
    }

    public function assists()
    {
        return $this->hasMany(Assist::class);
    }

    public function defnotes()
    {
        return $this->belongsToMany(User::class,'default_notes');
    }
}
