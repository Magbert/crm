<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Project;
use App\Task;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_users()
    {
        $response = $this->json('GET', route('users.index'), []);
        $response->assertStatus(200);;
    }
}
