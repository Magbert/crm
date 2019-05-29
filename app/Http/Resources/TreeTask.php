<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TreeTask extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subtasks' => new TreeTaskCollection($this->children)
        ];
    }
}
