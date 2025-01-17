<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MiniTaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'count' => $this->collection->count(),
            'data' => $this->collection,
        ];
    }
}
