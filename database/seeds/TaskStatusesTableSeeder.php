<?php

use Illuminate\Database\Seeder;
use App\TaskStatus;

class TaskStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskStatus::create(['name' => 'В работе']);
        TaskStatus::create(['name' => 'Приостановлена']);
        TaskStatus::create(['name' => 'Статус 1']);
        TaskStatus::create(['name' => 'Статус 2']);
        TaskStatus::create(['name' => 'Статус 3']);
        TaskStatus::create(['name' => 'Статус 4']);
    }
}
