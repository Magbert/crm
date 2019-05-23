<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\Task;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Project model
     * 
     * @var \App\Project
     */
    protected $project = null;

    /**
     * Tasks models
     * 
     * @var array
     */
    protected $tasks = [];

    /**
     * Task
     * 
     * @var App\Task
     */
    protected $task = null;

    /**
     * root tasks count
     * 
     * @var int
     */
    const ROOT_TASKS_COUNT = 10;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->tasks = factory(Task::class, self::ROOT_TASKS_COUNT)->create();
        $this->task = $this->tasks[5];

        $this->project->tasks()->saveMany($this->tasks);
    }

    /** @test */
    public function test_create_root_task()
    {
        $data = [
            "data" => [
                "name" => "Task name",
                "description" => "Task description",
                "project_id" => $this->project->id
            ]
        ];
        $response = $this->json('POST', route('tasks.store', $this->project->id), $data['data']);

        $response->assertStatus(201)
            ->assertJson($data);
    }

    /** @test */
    public function test_get_root_tasks()
    {
        $response = $this->json('GET', route('tasks.index', $this->project->id));

        $response->assertStatus(200)
            ->assertJsonCount(self::ROOT_TASKS_COUNT, 'data');
    }

    /** @test */
    public function test_get_task()
    {
        $response = $this->json('GET', route('tasks.show', [$this->project->id, $this->task->id]));

        $response->assertStatus(200);
    }

    /** @test */
    public function test_create_sub_task()
    {
        $data = [
            'name' => 'New task',
        ];

        $response = $this->json('POST', route('tasks.store', $this->project->id), $data);

        $response->assertStatus(201);
    }

    /** @test */
    public function test_task_rename()
    {
        $data = [
            'name' => 'Name update'
        ];

        $response = $this->json('PUT', route('tasks.update', [$this->project->id,  $this->task->id]), $data);

        $response->assertStatus(202);
    }

    /** @test */
    public function test_task_update()
    { }

    /** @test */
    public function test_task_delete()
    { }

    /** @test */
    public function test_task_move()
    { }
}
