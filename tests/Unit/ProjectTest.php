<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class ProjectTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_get_projects_list()
    {
        $response = $this->json('GET', "/api/projects", []);
        $response
            ->assertStatus(200);
        //->assertJsonCount(30, 'data');
    }

    /** @test */
    public function test_projects_order_latest()
    {
        $project = factory(Project::class)->create();
        $response_data  = $this->json('GET', "/api/projects")->decodeResponseJson();
        $this->assertEquals($response_data['data'][0]['id'], $project->id);
    }

    /** @test */
    public function test_get_project_by_id()
    {
        $project = factory(Project::class)->create();
        $response = $this->json('GET', "/api/projects/$project->id", []);
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $project->name,
                    'id' => $project->id,
                ]
            ]);
    }

    /** @test */
    public function test_create_project()
    {
        $data = [
            "name" => "Projectnae"
        ];
        $response = $this->json('POST', route('projects.store'), $data);
        $response->assertStatus(201);
    }

    /** @test */
    public function test_update_project()
    {
        $project = factory(Project::class)->create();
        $response = $this->json('PUT', route('projects.update', $project->id), ["name" => "new name"]);
        $upadate_project = Project::find($project->id);
        $this->assertEquals($upadate_project->name, "new name");
    }

    /** @test */
    public function test_delete_project()
    {
        $project = factory(Project::class)->create();
        $response = $this->json('DELETE', route('projects.destroy', $project->id));
        $upadate_project = Project::withTrashed()->find($project->id);
        $this->assertTrue($upadate_project->trashed());
    }
}
