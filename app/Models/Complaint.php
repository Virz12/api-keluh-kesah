<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
  // The attributes that are mass assignable.
  protected $fillable = [
    'user_id',
    'title',
    'content',
    'can_comment'
  ];

  // Relation
  public function user() {
    return $this->belongsTo(User::class);
  }

  public function comments() {
    return $this->hasMany(Comment::class);
  }
}
