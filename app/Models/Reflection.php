<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reflection extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'title',
        'content',
    ];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
