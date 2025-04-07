<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class viewTest extends TestCase
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

    public function testview()
    {
        $this->get("/hello")
            ->assertSeeText("Hello Hanif");

        $this->get("/hello-again")
            ->assertSeeText("Hello Hanif");
    }

    public function testviewnoroute()
    {
        $this->view('hello', ['name' => 'Hanif'])
            ->assertSeeText('Hello Hanif');

        $this->view('hello.world', ['name' => 'Hanif'])
            ->assertSeeText('Hello Hanif');
    }

    public function testnestedview()
    {
        $this->get('/hello-world')
            ->assertSeeText("Hello Hanif");
    }
}
