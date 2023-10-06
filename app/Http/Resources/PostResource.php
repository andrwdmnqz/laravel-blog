<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'link' => $this->link,
            'user' => $this->user->name,
            'text' => $this->text,
            'image_path' => $this->image_path,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
