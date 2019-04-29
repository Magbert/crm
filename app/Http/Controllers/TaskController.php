<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Resources\TaskCollection;
use App\Task;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\RootTaskCollection;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks()->whereIsRoot()->get();
        return new RootTaskCollection($tasks);
    }

    public function show(Task $task)
    {
        return new TaskResource($task);
    }

    // public function tasksTree(Project $project)
    // { 
    //     $tasks_tree = $project->tasks()->minified()->get()->toTree();
    //     return new TaskCollection($tasks_tree);
    // }
}
