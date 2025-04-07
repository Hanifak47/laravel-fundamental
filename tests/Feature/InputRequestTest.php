<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_request_input()
    {
        // jika routenya get maka paramnya by url
        $this->get('/input/hello?name=Hanif')
            ->assertSeeText('Hello Hanif');
        // jika routenya post maka paramnya by post value
        $this->post(
            '/input/hello',
            ['name' => 'Hanif']
        )
            ->assertSeeText('Hello Hanif');
    }

    public function test_request_nested()
    {
        $this->post('/input/hello/first', [
            'name' => [
                'first' => 'Hanif',
                'last' => 'kusuma'
            ]
        ])->assertSeeText('Hello Hanif');
    }

    public function test_input_all()
    {
        $this->post('/input/hello/input', [
            'name' => [
                'first' => 'Hanif',
                'last' => 'Kusuma'
            ]
        ])->assertSeeText('name')
            ->assertSeeText('first')
            ->assertSeeText('last')
            ->assertSeeText('Hanif')
            ->assertSeeText('Kusuma');
    }

    public function test_input_city()
    {
        $this->post('/input/hello/inputcity', [
            'Address' => [
                [
                    'city' => 'Sidoarjo',
                    'country' => 'Indonesia'
                ],
                [
                    'city' => 'Riyadh',
                    'country' => 'Saudi Arabia'
                ]
            ]
        ])
            // ->assertSeeText('Address')
            // ->assertSeeText('city')
            // ->assertSeeText('country')
            ->assertSeeText('Sidoarjo')
            // ->assertSeeText('Indonesia')
            ->assertSeeText('Riyadh');
        // ->assertSeeText('Saudi Arabia');
    }

    public function test_input_type()
    {
        $this->post('/input/type', [
            [
                'name' => 'Hanif',
                'married' => false,
                'birth_date' => '1997-08-02'
            ]
        ])->assertSeeText('Hanif')
            ->assertSeeText('true')
            ->assertSeeText('1997-08-02');
    }

    public function test_filter_only()
    {
        $this->post('/filter/only', [
            'name' => [
                'firstname' => 'Hanif',
                'middlename' => 'Aulia',
                'lastname' => 'Kusuma'
            ]
        ])
            ->assertSeeText('Hanif')
            ->assertSeeText('Kusuma')
            ->assertDontSeeText('Aulia')
        ;
    }

    public function test_filter_except()
    {
        $this->post('/filter/except', [
            'admin' => 'admin',
            'guru' => 'guru',
            'siswa' => 'siswa',
            'tendik' => 'tendik'
        ])
            ->assertSeeText('guru')
            ->assertSeeText('siswa')
            ->assertSeeText('tendik')
            ->assertDontSeeText('admin');
        ;
    }

    public function test_filter_merge()
    {
        $this->post('/filter/merge', [
            'admin' => true,
            'nama' => [
                'firstname' => 'Hanif',
                'lastname' => 'Kusuma'
            ]
        ])->assertSeeText('Hanif')
        ->assertSeeText('Kusuma')
        ->assertSeeText('false')
        ;
    }

    
}
