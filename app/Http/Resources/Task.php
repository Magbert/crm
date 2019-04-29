<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskCollection;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'completed' => $this->completed,
            'due_at' => $this->due_at,
            'parent_id' => $this->parent_id,
            'subtasks' => $this->children->makeHidden('description'),
        ];
    }
}
