<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
// use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AppEnvironmentTest extends TestCase
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

    public function testAppEnv()
    {
        if (App::environment('testing')) {
            self::assertTrue(true);
        }

        // if (App::environment(['testing', 'prod', 'dev'])) {
        //     self::assertTrue(true);
        // }
    }
}
