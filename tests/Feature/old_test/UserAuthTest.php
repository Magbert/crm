<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class UserAuthTest extends TestCase
{
    // public function test_user_can_view_a_login_form()
    // {
    //     $response = $this->get('/login');
    //     $response->assertSuccessful();
    //     $response->assertViewIs('auth.login');
    // }


    // // public function test_user_redirect_login_form()
    // // {
    // //     $response = $this->get('/');
    // //     $response->assertRedirect('/login');
    // // }


    // public function test_redirect_to_dasboard_after_authenticated()
    // {
    //     $user = $this->getUser();
    //     $response = $this->post('/login', [
    //         'email' => $user->email,
    //         'password' => config('test.employee.secret'),
    //     ]);

    //     $response->assertRedirect('/');
    // }


    // public function test_user_cannot_view_a_login_form_when_authenticated()
    // {
    //     $user = $this->getUser();
    //     $response = $this->actingAs($user)->get('/login');
    //     $response->assertRedirect('/');
    // }

    // public function getUser()
    // {
    //     return user::where('name', config('test.employee.name'))->first();
    // }
}
