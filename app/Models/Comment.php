<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // The attributes that are mass assignable.
  protected $fillable = [
    'complaint_id',
    'user_id',
    'content',
  ];

  // Relation
  public function complaint() {
    return $this->belongsTo(Complaint::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }
}
