<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RedirectControllerTest extends TestCase
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


    public function test_redirect()
    {
        $this->get('/redirect/from')
            ->assertRedirect('/redirect/to');
    }

    public function testRedirectName()
    {
        $this->get('/redirect/name')
            ->assertRedirect('/redirect/name/Hanif');
    }

    public function testredirectAction()
    {
        $this->get('/redirect/action')
            ->assertRedirect('/redirect/name/Hanif');
    }

    public function testredirectAway()
    {
        $this->get('/redirect/mediato')
        ->assertRedirect('mediato.site');
    }

}
