<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplaintResource extends JsonResource
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
      'created_by' => $this->user->name,
      'title' => $this->title,
      'content' => $this->content,
      'can_comment' => (bool) $this->can_comment,
      'comments' => CommentResource::collection($this->whenLoaded('comments')),
    ];
  }
}
