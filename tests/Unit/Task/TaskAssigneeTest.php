<?php

namespace Tests\Unit\Task;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\Task;
use App\User;
use Carbon\Carbon;

class TaskAssigneeTest extends TestCase
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

    /**
     * Task
     * 
     * @var App\User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->project = factory(Project::class)->create();
        $this->user = factory(User::class)->create();
        $this->task = factory(Task::class)->create(['project_id' => $this->project->id, 'due_at' => null]);
    }

    public function test_set_assignee()
    {
        $response = $this->json('POST', route('tasks.assignee.assign', $this->task->id), ['user_id' => $this->user->id]);

        $response->assertStatus(200);

        $task = Task::find($this->task->id);
        $this->assertEquals($this->user->id, $task->assignee->id);
    }

    public function test_remove_assignee()
    {
        $response = $this->json('DELETE', route('tasks.assignee.remove', $this->task->id));
        $response->assertStatus(200);
        
        $task = Task::find($this->task->id);
        $this->assertEquals($task->assignee, null);
    }
}
