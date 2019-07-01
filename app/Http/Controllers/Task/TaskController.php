<?php
namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Project;
use App\Task;
use App\Http\Resources\TreeTaskCollection;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\RootTaskCollection;
use App\Http\Requests\StoreTask;

class TaskController extends Controller
{
    /**
     * Выводит задачи проекта
     */
    public function index(Project $project)
    {
        $tasks = $project->tasks()->defaultOrder()->get();
        
        return new TreeTaskCollection($tasks->toTree(), $tasks->count());
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

        return new TaskResource($task);
    }

    /**
     * Обновление задачи
     */
    public function update(StoreTask $request,  Task $task)
    {
        $task->update($request->all());

        return response('', 202);
    }

    /**
     * Удаление задачи
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response('', 200);
    }

    /**
     * Возврашает задачи проекта в виде дерево
     */
    public function tree(Project $project)
    {
        $tasks = $project->tasks()->defaultOrder()->get();
        return (new TreeTaskCollection($tasks->toTree()))->additional([
            'meta' => [
                'count' => $tasks->count(),
            ]
        ]);
    }

    /**
     * Обновляет дерево задач
     */
    public function rebuild(Project $project, Request $request)
    {
        return Task::scoped(['project_id' => $project->id])->rebuildTree($request->tree);
    }
}
