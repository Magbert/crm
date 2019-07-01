<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Customer;


class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function test_get_customers_list()
    {
        $response = $this->json('GET', "/api/customers", []);
        $response
            ->assertStatus(200);
    }

    /** @test */
    public function test_customers_order_latest()
    {
        $customer = factory(Customer::class)->create();
        $response_data  = $this->json('GET', "/api/customers")->decodeResponseJson();
        $this->assertEquals($response_data['data'][0]['id'], $customer->id);
    }

    /** @test */
    public function test_get_customer_by_id()
    {
        $customer = factory(Customer::class)->create();
        $response = $this->json('GET', "/api/customers/$customer->id");
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => $customer->name,
                    'id' => $customer->id,
                ]
            ]);
    }

    /** @test */
    public function test_create_customer()
    {
        $data = [
            "name" => "customer",
            "email" => "testmail@mail.ru",
            "password" => "password"
        ];
        $response = $this->json('POST', route('customers.store'), $data);
        $response->assertStatus(201)->assertJson([
            'data' => [
                'name' => $data["name"],
                'email' => $data["email"],
            ]
        ]);
    }

    /** @test */
    public function test_update_customer()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->json('PUT', route('customers.update', $customer->id), [
            "name" => "new name",
            "email" => $customer->email,
            "password" => "password",
        ]);
        $response->assertStatus(202);

        $upadate_customer = Customer::find($customer->id);

        $this->assertEquals($upadate_customer->name, "new name");
    }

    /** @test */
    public function test_delete_customer()
    {
        $customer = factory(Customer::class)->create();
        $response = $this->json('DELETE', route('customers.destroy', $customer->id));
        $response->assertStatus(204);

        $this->assertNull(Customer::find($customer->id));
    }
}
