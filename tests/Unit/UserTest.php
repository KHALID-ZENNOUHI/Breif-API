<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_be_created()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertCount(1, User::all());
    }

    public function test_user_can_be_updated()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response = $this->putJson('/api/users/' . $user->id, [
            "name" => "Test2 User",
            "email" => "test2@example.com", // Provide an email
            "password" => "newpassword", // Provide a password
        ]);
        $response->assertStatus(202);
        $this->assertEquals("Test2 User", $response['data']['name']);
    }

}