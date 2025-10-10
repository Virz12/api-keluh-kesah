<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id',
        'complaint_id',
    ];

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaint()
    {
        return $this->belongsTo(Complaint::class);
    }
}
