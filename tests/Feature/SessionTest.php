<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SessionTest extends TestCase
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

    public function test_create()
    {
        $this->get('/session/create')
            ->assertSeeText('OK')
            ->assertSessionHas("userId", "Hanif")
            ->assertSessionHas("isMember", "true")
        ;
    }

    public function test_get(){
        $this->withSession([
            'userId' => 'Hanif',
            'isMember' => 'true'
        ])->get('/session/get')
        ->assertSeeText('Hanif')
        ->assertSeeText('true')
        ;
    }

    public function test_zero_get(){
        $this->withSession([
            // 'userId' => 'Hanif',
            // 'isMember' => 'true'
        ])->get('/session/get')
        ->assertSeeText('User Id: guest, Is Member: false')
        ;
    }
}
