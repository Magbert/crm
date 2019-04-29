<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomersTableSeeder extends Seeder
{
    public function run()
    {
        //Клиент
        Customer::create([
            'name' => config('test.customer.name'),
            'email' => config('test.customer.email'),
            'email_verified_at' => config('test.customer.email_verified_at'),
            'password' => config('test.customer.password'),
        ]);

        // Рандомные клиенты
        factory(App\Customer::class, 50)->create();
    }
}
