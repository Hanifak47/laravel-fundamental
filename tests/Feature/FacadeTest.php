<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;
// use Illuminate\Support\Facades\
use Tests\TestCase;

class FacadeTest extends TestCase
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

    public function testconfig()
    {
        $tes1 = config('contoh.nama.firstname');
        $tes2 = Config::get('contoh.nama.firstname');

        self::assertSame($tes1, $tes2);
        var_dump(config::all());
    }

    public function testconfigmock()
    {
        // seluruh class facades memiliki should recive
        // config::shouldReceive()
        // Log::shouldReceive()
        // App::shouldReceive()
        // Crypt::shouldReceive()
      
        // Config::shouldReceive('get')
        //     ->with('contoh.nama.firstname')
        //     ->andReturn('Hanif Ganteng');           
        // // Config::makePartial();

        Config::set('contoh.nama.firstname', 'Hanif Ganteng');
 
        $tes1 = config('contoh.nama.firstname');

        self::assertEquals('Hanif Ganteng', $tes1);
    }
}
