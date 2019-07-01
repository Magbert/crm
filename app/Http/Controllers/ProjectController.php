<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Project;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate();
        
        return new ProjectCollection($projects);
    }


    public function store(StoreProject $request)
    {
        $project = Project::create($request->all());

        return new ProjectResource($project);
    }


    public function show(Project $project)
    {
        return new ProjectResource($project);
    }


    public function update(StoreProject $request, Project $project)
    {
        $project->update($request->all());

        return response('', 202);
    }


    public function destroy(Project $project)
    {
        $project->delete();

        return response('', 200);
    }
}
