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
            'show' => true,
            'due_time' => $this->due_time,
            'children' => new TreeTaskCollection($this->children)
        ];
    }
}
