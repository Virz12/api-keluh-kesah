<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'commented_by_id' => $this->user->id,
      'commented_by' => $this->user->name,
      'content' => $this->content,
      'time_passed' => $this->created_at->diffForHumans(),
    ];
  }
}
