<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RootTask extends JsonResource
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
            'completed' => $this->completed,
            'due_at' => $this->due_at,
            'parent_id' => $this->parent_id,
        ];
    }
}
