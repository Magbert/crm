<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\User\MiniUser;

class Task extends JsonResource
{
    /**
     * Возврашает ресурс с подзадачами
     */
    public function toArray($request)
    {
        $children = $this->children->makeHidden('description');
        $ancestors = Task::scoped(['project_id' => $this->project_id])->defaultOrder()->ancestorsOf($this->id, ['name', 'id']);
        $assignee = new MiniUser($this->assignee);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'completed' => $this->completed,
            'due_time' => $this->due_time,
            'parent_id' => $this->parent_id,
            'project_id' => $this->project_id,
            'created_time' => $this->created_time,
            'status' => $this->status,
            'children' => $children,
            'ancestors' => $ancestors,
            'assignee' => $assignee,
            'show' => true,
        ];
    }
}
