<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'user_id'];
    protected $perPage = 30;
    protected $with = ['customer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // public function tasksMinified()
    // {
    //     return $this->hasMany(Task::class)->select(['id', 'name', 'completed', 'parent_id', 'due_at', '_lft', '_rgt']);
    // }
}
