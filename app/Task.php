<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use NodeTrait;

    protected $dates = ['created_at', 'updated_at', 'due_at'];
    // protected $hidden = ['description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeMinified($query)
    {
        return $query->select(['id', 'name', 'completed', 'parent_id', 'due_at', '_lft', '_rgt']);
    }

    protected function getScopeAttributes()
    {
        return ['project_id'];
    }
}
