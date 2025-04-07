<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseControllerTest extends TestCase
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

    public function test_response()
    {
        $this->get('/response/default')
            ->assertStatus(200)
            ->assertSeeText("Hello response");
        ;
    }

    public function test_header()
    {
        $this->get('/response/header')
            ->assertStatus(200)
            ->assertSeeText("firstName")
            ->assertSeeText("Hanif")
            ->assertSeeText("lastName")
            ->assertSeeText("Kusuma")
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Author', 'Sans Coding')
            ->assertHeader('App', 'Belajar Laravel')
        ;
        ;
    }

    public function test_view()
    {
        $this->get('response/view')
            ->assertSeeText('Hello Hanif');
    }

    public function test_json()
    {
        $this->get('response/json')
            ->assertJson(['firstname' => 'Hanif', 'lastname' => 'Kusuma']);
    }

    public function test_file()
    {
        $this->get('/response/file')
            ->assertHeader('Content-type', 'image/png');
    }

    public function test_download()
    {
        $this->get('/response/download')
            ->assertDownload('Hanif.png');
    }


    public function test_group_view()
    {
        $this->get('/response/type/view')
            ->assertSeeText('Hello Hanif');
    }

    public function test__group_json()
    {
        $this->get('/response/type/json')
            ->assertJson(['firstname' => 'Hanif', 'lastname' => 'Kusuma']);
    }

    public function test__group_file()
    {
        $this->get('/response/type/file')
            ->assertHeader('Content-type', 'image/png');
    }

    public function test__group_download()
    {
        $this->get('/response/type/download')
            ->assertDownload('Hanif.png');
    }


}
