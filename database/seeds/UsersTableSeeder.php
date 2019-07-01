<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Сотрудник
        User::create([
            'name' => config('test.employee.name'),
            'email' => config('test.employee.email'),
            'email_verified_at' => config('test.employee.email_verified_at'),
            'password' => config('test.employee.password'),
        ]);

        // Рандомные сотрудники
        factory(App\User::class, 7)->create();
    }
}
