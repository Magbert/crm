<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Auth\User;

class UserTest extends TestCase
{
    public function test_get_users()
    {
        $response = $this->json('GET', route('user.index'), []);
        $response
            ->assertStatus(200)
            ->assertJsonCount(User::count(), 'data');
    }
}
