<?php

namespace Tests\Unit\Task;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\Task;
use Carbon\Carbon;

class TaskDueDateTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * Project model
     * 
     * @var \App\Project
     */
    protected $project = null;

    /**
     * Task
     * 
     * @var App\Task
     */
    protected $task;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->task = factory(Task::class)->create(['project_id' => $this->project->id, 'due_at' => null]);
    }

    public function test_set_due_date()
    { }

    public function test_set_due_time()
    {
        $date = Carbon::now()->addMonth();

        $data = ['due_time' => $date->valueOf()];
        $response = $this->json('PUT', route('tasks.set_due_date', [$this->task->id]), $data);
        $task = Task::find($this->task->id);

        $response->assertStatus(202);
        $this->assertEquals($task->due_at->toDateTimeString(), $date->toDateTimeString());
    }

    public function test_remove_due_date()
    {
        $data = ['due_time' => null];
        $response = $this->json('PUT', route('tasks.set_due_date', [$this->task->id]), $data);
        $task = Task::find($this->task->id);

        $response->assertStatus(202);
        $this->assertEquals($task->due_at, null);
    }
}
