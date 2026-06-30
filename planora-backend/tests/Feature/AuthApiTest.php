<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthApiTest extends TestCase
{
    public function test_login_requires_required_fields(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors([
            'email',
            'password',
        ]);
    }

    public function test_login_must_logged(){
        
    }
}