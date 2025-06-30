<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HelloApiTest extends TestCase
{
    /**
     * Test the /api/hello endpoint.
     */
    public function test_hello_api_endpoint(): void
    {
        $response = $this->get('/api/hello');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Szia Nagyvilág!']);
    }
}
