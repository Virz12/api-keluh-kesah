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
      'commented_by' => $this->user->name,
      'complaint_name' => $this->whenLoaded('complaint') ? $this->complaint->title : null,
      'content' => $this->content
    ];
  }
}
