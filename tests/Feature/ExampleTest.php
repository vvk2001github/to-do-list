<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->getJson('/tasks');

        $response->assertOk();
    }

    public function test_the_application_returns_a_failed_response(): void
    {
        $response = $this->postJson('/tasks');

        $response->assertUnprocessable();
    }
}
