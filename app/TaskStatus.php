<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'key'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
