<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'tasks',
        'projects',
        'users',
        'roles',
        'customers',
        'task_statuses',
    ];


    public function run()
    {
        $this->cleanDatabase();
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(TaskStatusesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
    }


    public function cleanDatabase()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
