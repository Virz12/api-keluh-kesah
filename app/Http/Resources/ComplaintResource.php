<?php

namespace App\Http\Resources;

use App\Models\Likes;
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
            'created_by_id' => $this->user->id,
            'created_by' => $this->user->name,
            'content' => $this->content,
            'likes' => count(Likes::where('complaint_id', $this->id)->get()),
            'can_comment' => (bool) $this->can_comment,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'time_passed' => $this->created_at->diffForHumans(),
        ];
    }
}
