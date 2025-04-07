<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class CryptTest extends TestCase
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

    public function test_encrypt()
    {
        $encrypt = Crypt::encrypt("Hanif Aulia Kusuma");
        $decrypt = Crypt::decrypt($encrypt);

        self::assertEquals("Hanif Aulia Kusuma", $decrypt);
    }
}
