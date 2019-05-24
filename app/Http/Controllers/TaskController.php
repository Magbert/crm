<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Http\Resources\TaskCollection;
use App\Task;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\RootTaskCollection;
use App\Http\Requests\StoreTask;
use Illuminate\Support\Facades\Response;

class TaskController extends Controller
{
    /**
     * Выводит задачи проекта верхнего уровня
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks()->whereIsRoot()->get();
        return new RootTaskCollection($tasks);
    }

    /**
     * Выводит задачу и подзадачами (только дочериние) 
     */
    public function show(Project $project, Task $task)
    {
        return new TaskResource($task);
    }

    /**
     * Создание новой задачи
     * Если передан $parent(task id) то новая задача добовляется в подзадачи $parent
     * Если не нет то задача сохраняется как рутовая(на верхнем уровне)
     */
    public function store(StoreTask $request, Project $project)
    {
        $request->merge(['project_id' => $project->id]);
        $task = Task::create($request->all());

        if ($request->filled('parent')) {
            Task::find($request->parent)->appendNode($task);
        }
        // Task::scoped(['project_id' => $project->id])->fixTree();
        return new TaskResource($task);
    }

    /**
     * Обновление задачи
     */
    public function update(StoreTask $request,  Task $task)
    {
        $affected = $task->update($request->all());

        return Response::make('', 202);
    }

    public function destroy(Task $task)
    {
        $affected = $task->delete();

        return Response::make('', 200);
    }







    // public function tasksTree(Project $project)
    // { 
    //     $tasks_tree = $project->tasks()->minified()->get()->toTree();
    //     return new TaskCollection($tasks_tree);
    // }
}
