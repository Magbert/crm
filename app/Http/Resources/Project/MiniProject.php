<?php

namespace App\Http\Resources\Project;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\MiniUser;
use App\Http\Resources\Customer\MiniCustomer;

class MiniProject extends JsonResource
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
            'user' => new MiniUser($this->user),
            'customer' => new MiniCustomer($this->customer),
        ];
    }
}
