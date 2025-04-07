<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_invalid()
    {
        $this->get('/middleware/api')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function test_valid()
    {
        $this
            ->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/api')
            ->assertStatus(200)
            ->assertSeeText("OK");
    }

    public function test_valid_group()
    {
        $this
            ->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/group')
            ->assertStatus(200)
            ->assertSeeText("GROUP");
    }

    public function test_invalid_group()
    {
        $this->get('/middleware/group')
            ->assertStatus(401)
            ->assertSeeText("Access Denied");
    }

    public function test_valid_param()
    {
        $this
            ->withHeader('X-API-KEY', 'PZN')
            ->get('/middleware/param')
            ->assertStatus(200)
            ->assertSeeText("PARAM")
            // ->assertSeeText(401)
            
            ;
    }

    public function test_invalid_param()
    {
        $this->get('/middleware/param')
            ->assertStatus(401)
            ->assertSeeText("Access Denied")
            // ->assertSeeText("401")
            ;
    }
}
