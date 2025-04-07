<?php

namespace Tests\Feature;

use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Data\Foo;
use App\Data\Bar;
use App\Data\Person;

class ServiceContainerTest extends TestCase
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

    public function testDependency()
    {
        $foo = $this->app->make(Foo::class);
        $foo2 = $this->app->make(Foo::class);
        self::assertEquals("Foo", $foo->foo());
        self::assertEquals("Foo", $foo2->foo());
        self::assertNotSame($foo, $foo2);
    }


    public function test_bind()
    {
        // jika membuat function maka returnya yg digunakan
        $this->app->bind(Person::class, function ($app) {
            return new Person("Hanif", "Kusuma");
        });

        // setiap penggunaan make maka function bind akan dipanggil
        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Hanif", $person1->firstname);
        self::assertEquals("Kusuma", $person2->lastname);
        self::assertNotSame($person1, $person2);
        self::assertSame($person1, $person2);
    }

    public function test_singleton()
    {
        // jika membuat function maka returnya yg digunakan
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Hanif", "Kusuma");
        });

        // setiap penggunaan make maka function bind akan dipanggil
        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Hanif", $person1->firstname);
        self::assertEquals("Kusuma", $person2->lastname);
        self::assertNotSame($person1, $person2);
        self::assertSame($person1, $person2);
    }

    public function test_instance()
    {
        $person = new Person("Hanif", "Kusuma");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class);
        $person2 = $this->app->make(Person::class);

        self::assertEquals("Hanif", $person1->firstname);
        self::assertEquals("Kusuma", $person2->lastname);

        self::assertNotSame($person1, $person2);

        self::assertSame($person1, $person2);
    }

    public function test_dependency_injection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        // $bar2 = $this->app->make(Bar::class);

        self::assertEquals("Foo and Bar", $bar->bar());

        self::assertEquals($foo, $bar->foo);
        self::assertSame($foo, $bar->foo);
    }

    // tes dependency injection dengan induk yang sama namun child yang berbeda

    public function test_dependency_injection_child()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $this->app->singleton(Foo::class, function ($app) {
            // return new Bar($app->make(Foo::class));
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
    }

    // penggunaan singleton untuk 
    public function test_interface_helloservice()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals("Halo Hanif", $helloService->hello('Hanif'));
    }

}
