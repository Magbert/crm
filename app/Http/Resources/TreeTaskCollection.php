<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TreeTaskCollection extends ResourceCollection
{
    public $tasksCount;

    public function __construct($resource, $count = 0)
    {
        $this->tasksCount = $count;
        
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'meta' => [
                'count' => $this->tasksCount,
            ],
        ];
    }
}
