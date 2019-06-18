<?php

use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Faker\Factory as Faker;

class ProjectsTableSeeder extends Seeder
{
    protected $max_level = 2;

    public function run()
    {
        $faker = Faker::create();
        $projects = factory(App\Project::class, 5)->create();
        $all_tasks = [];

        foreach ($projects as  $project) {
            $root_tasks = factory(App\Task::class, 5)->create([
                'project_id' => $project->id
            ]);

            foreach ($root_tasks as $root_task) {
                $this->addSubtasks($root_task);
            }

            //$project->tasks()->saveMany($root_tasks);
        }
    }

    // public function addTasks()
    // {
    //     $root_tasks = factory(App\Task::class, 10)->create();
    //     foreach ($root_tasks as $root_task) {
    //         $this->addSubtasks($root_task, $faker->numberBetween(1, 4));
    //     }
    // }

    public function addSubtasks($parent, $level = 1)
    {
        $faker = Faker::create();
        $tasks = factory(App\Task::class,  $faker->numberBetween(2, 4))->create([
            'project_id' => $parent->project->id
        ]);

        foreach ($tasks as $task) {
            if ($this->max_level > $level) {
                $this->addSubtasks($task, $level + 1);
            }
            $parent->appendNode($task);
        }
    }
}
