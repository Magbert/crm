<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\Task\MiniTaskCollection;
use App\Http\Resources\Project\MiniProjectCollection;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $tasks = new MiniTaskCollection($this->tasks);
        $projects = new MiniProjectCollection($this->projects);
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'secret' => $this->secret,
            'phone' => $this->phone,
            'of_phone' => $this->of_phone,
            'projects' => $projects,
            'tasks' => $tasks
        ];
    }
}
