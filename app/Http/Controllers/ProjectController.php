<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Project;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;

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
        $affected = $project->update($request->all());

        return Response::make('', 202);
    }


    public function destroy(Project $project)
    {
        $affected = $project->delete();

        return Response::make('', 200);
    }
}
