<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskCollection;

class Task extends JsonResource
{
    /**
     * Возврашает ресурс с подзадачами
     */
    public function toArray($request)
    {
        $children = $this->children->makeHidden('description');
        $ancestors = Task::scoped(['project_id' => $this->project_id])->defaultOrder()->ancestorsOf($this->id, ['name', 'id']);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'completed' => $this->completed,
            'due_time' => $this->due_time,
            'parent_id' => $this->parent_id,
            'project_id' => $this->project_id,
            'children' => $children,
            'ancestors' => $ancestors,
            'show' => true,
        ];
    }
}
