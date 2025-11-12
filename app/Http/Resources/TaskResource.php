<?php

namespace App\Http\Resources;

use App\Http\Resources\Common\CommonJsonResource;
use Illuminate\Http\Request;

class TaskResource extends CommonJsonResource
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
            'description' => $this->description,
            'status' => $this->status ?? 0,
        ];
    }
}
