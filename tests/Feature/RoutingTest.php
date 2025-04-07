<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{

    // test routing
    public function testGet()
    {
        $this->get('/pzn')
            ->assertStatus(200)
            ->assertSeeText("Hello Hanif");
    }

    // test redirect
    public function testRedirect()
    {
        $this->get("/youtube")
            ->assertRedirect("/pzn");
    }


    // test fallback
    public function testfallback()
    {
        // halamantidakada merupakan route yg belum ditentukan
// text halamantidak ada bisa diganti dengan apappun itu
        $this->get("/halamantidakada")
            ->assertSeeText("404");
    }

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

    public function test_route_param()
    {
        $this->get("/products/1")
            ->assertSeeText('Products: 1');


        $this->get("/products/1/items/2")
            ->assertSeeText('Products: 1, Items: 2');
    }

    public function test_route_numberonly()
    {
        $this->get('/categories/12345')
            ->assertSeeText('Categories: 12345');


        $this->get('/categories/abcde')
            ->assertSeeText('404');
    }

    public function test_route_optional()
    {
        $this->get('/users/12')
            ->assertSeeText('Users: 12');


        $this->get('/users/')
            ->assertSeeText('Users: 404');
    }

    public function test_conflict()
    {
        $this->get('/conflict/hanif')
            ->assertSeeText('Conflict: hanif');
    }

    public function test_named_route()
    {
        $this->get('/produk/12345')
            ->assertSeeText('products/12345');


        $this->get('/product-redirect/12345')
            ->assertSeeText('products/12345');
    }

    public function test_route_controller()
    {
        $this->get('/controller/hello')
            ->assertSeeText('Hello World')
        ;
    }

    public function test_route_dependency_injection()
    {
        $this->get('/controller/hello/hanif')
            ->assertSeeText('Halo hanif');
    }

    public function test_request()
    {
        $this->get('/controller/hellobro/request', [
            'Accept' => 'plain/text'
        ])->assertSeeText('controller/hellobro/request')
            ->assertSeeText('http://localhost/controller/hellobro/request')
            ->assertSeeText('GET')
            ->assertSeeText('plain/text')
        ;
    }

    public function testNamed()
    {
        $this->get('/url/named')->assertSeeText('/redirect/name/Hanif');
    }

    public function testAction()
    {
        $this->get('/url/action')->assertSeeText('/form');
    }
}
