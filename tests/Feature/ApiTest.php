<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Igbe Ajaga',
            'email' => 'igbeajaga@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }
}
