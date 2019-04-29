<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'count' => $this->collection->count(),
            'data' => $this->collection,
        ];
    }
}
