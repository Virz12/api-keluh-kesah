<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'content',
        'can_comment',
    ];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class, 'complaint_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'complaint_id');
    }
}
