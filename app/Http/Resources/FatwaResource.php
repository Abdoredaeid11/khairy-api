<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FatwaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $typeLabels = [
            'qa' => 'سؤال وجواب',
            'video' => 'فيديو',
            'ruling' => 'فتوى شرعية',
            'article' => 'مقال',
        ];

        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'type_label' => $typeLabels[$this->type] ?? $this->type,
            'content' => $this->whenNotNull($this->content),
            'video_url' => $this->whenNotNull($this->video_url),
            'is_published' => (bool) $this->is_published,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
