<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    use NodeTrait;

    protected $with = ['status'];
    
    protected $fillable = ['name', 'description', 'project_id', 'due_at', 'due_time', 'status_id'];

    protected $dates = ['created_at', 'updated_at', 'due_at'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function scopeMinified($query)
    {
        return $query->select(['id', 'name', 'completed', 'parent_id', 'due_at', '_lft', '_rgt']);
    }

    public function getDueTimeAttribute()
    {
        return $this->due_at ? $this->due_at->valueOf() : null;
    }

    public function getCreatedTimeAttribute()
    {
        return $this->created_at->valueOf();
    }

    public function setDueTimeAttribute($due_time)
    {
        $this->due_at = !is_null($due_time) ? $due_time / 1000 : null;
    }

    protected function getScopeAttributes()
    {
        return ['project_id'];
    }
}
