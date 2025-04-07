<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Env;
use Tests\TestCase;

class EnvironmentTest extends TestCase
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

    public function testGetEnv()
    {
        $youtube = env("YOUTUBE");

        self::assertEquals("Hanif Channel", $youtube);
    }

    public function testDefaultEnv(){
        $author = env('AUTHOR', 'Hanif');
        self::assertEquals('Hanif', $author);
    }
}
