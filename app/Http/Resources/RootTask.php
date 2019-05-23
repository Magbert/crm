<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RootTask extends JsonResource
{
    /**
     * Возврашает ресур без подзадач
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'completed' => $this->completed,
            'due_at' => $this->due_at,
            'parent_id' => $this->parent_id,
            'project_id' => $this->project_id,
        ];
    }
}
