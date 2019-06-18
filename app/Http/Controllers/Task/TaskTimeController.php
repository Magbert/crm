<?php

namespace App\Http\Controllers\Task;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Task as TaskResource;
use Illuminate\Support\Facades\Response;
use App\Task;

class TaskTimeController extends Controller
{
    public function setDueDate(Task $task, Request $request)
    {
        $task->due_time = $request->due_time;
        $task->save();

        return Response::make('', 202);
    }

    public function removeDueDate(Task $task)
    { }
}
