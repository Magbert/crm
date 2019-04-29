<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DBProjectTest extends TestCase
{
    use DatabaseTransactions;

    public function test_eloquent_create_project()
    {

        $project = factory(Project::class)->create();
        //        Project::create([
        //            'name' => 'Test project name',
        //            'description' => 'Test project description',
        //        ]);

        $this->assertDatabaseHas('projects', [
            'name' => $project->name,
            'description' => $project->description,
        ]);
    }
}
