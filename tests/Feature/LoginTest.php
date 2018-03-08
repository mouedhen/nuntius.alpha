<?php

namespace Tests\Feature;

use App\Models\Auth\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        factory(User::class)->create(['email' => 'testlogin@user.com', 'password' => 'test123']);
    }

    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/v1/login')
            ->assertStatus(422)
            ->assertJson([
                "The given data was invalid.",
                [
                    "email" => [
                        "The email field is required."
                    ],
                    "password" => [
                        "The password field is required."
                    ]
                ]
            ]);
    }

    public function testUserLoginSuccessfully()
    {
        $payload = ['email' => 'testlogin@user.com', 'password' => 'test123'];

        $this->json('POST', 'api/v1/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }
}
