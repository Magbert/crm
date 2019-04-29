<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TestController extends Controller
{
    public function index()
    {
        // $task = Task::find(1);
        $task = Task::descendantsAndSelf(1)->toTree()->first();
        $task = Task::descendantsOf(1)->toTree(1);
        $task = Task::scoped(['project_id' => 1])->withDepth()->get();
        $task = Task::scoped(['project_id' => 1])->whereIsLeaf()->get();
        $task = Task::find(2)->descendants()->get();

        // $tasks_tree = Task::find(1)->get()->toTree();
        // dd($tasks_tree);
        dd($task);
    }
}
