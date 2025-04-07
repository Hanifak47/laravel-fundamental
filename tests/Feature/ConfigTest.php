<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
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

    public function test_config()
    {
        $firstname = config('contoh.nama.firstname');
        $lastname = config('contoh.nama.lastname');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals($firstname, 'Hanif');
        self::assertEquals($lastname, 'Kusuma');
        self::assertEquals($email, 'hanifsmurf@gmail.com');
        self::assertEquals($web, 'hanif.com');
        
    }
}
