<?php

namespace Tests\Feature\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Customer;
use Illuminate\Support\Facades\Log;

class CustomerAuthTest extends TestCase
{
    // public function test_customer_can_view_a_login_form()
    // {
    //     $response = $this->get('/customer/login');
    //     $response->assertSuccessful();
    //     $response->assertViewIs('customer.auth.login');
    // }


    // public function test_customer_redirect_login_form()
    // {
    //     $response = $this->get('/customer');
    //     $response->assertRedirect('/customer/login');
    // }


    // public function test_redirect_to_dasboard_after_authenticated()
    // {
    //     $customer = $this->getCustomer();
    //     $response = $this->post('/customer/login', [
    //         'email' => $customer->email,
    //         'password' => config('test.customer.secret'),
    //     ]);

    //     $response->assertRedirect('/customer');
    // }

    // public function test_invalid_login_credentials()
    // {
    //     $customer = $this->getCustomer();
    //     $this->assertInvalidCredentials([
    //         'email' => $customer->email,
    //         'password' => 'notValidSecret'
    //     ], 'customer');
    // }


    // public function test_user_cannot_view_a_login_form_when_authenticated()
    // {
    //     $customer = $this->getCustomer();
    //     $response = $this->actingAs($customer, 'customer')->get('/customer/login');
    //     $response->assertRedirect('/customer');
    // }

    // public function getCustomer()
    // {
    //     return Customer::where('name', config('test.customer.name'))->first();
    // }
}
