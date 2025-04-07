<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use \Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

// use GuzzleHttp\Psr7\UploadedFile;
// use Illuminate\Http\UploadedFile;

class FileStorageTest extends TestCase
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

    public function testStorage()
    {
        // masuk ke storage/app
        $filesystem = Storage::disk('local');

        // buat dan isi file
        $filesystem->put("file.txt", "Hanif Aulia Kusuma");

        // baca file yang sudah dibuat disimpan pada variabel content
        $content = $filesystem->get('file.txt');

        // tes apakah isinya benar
        self::assertEquals("Hanif Aulia Kusuma", $content);
    }


    public function testPublicStorage()
    {
        // masuk ke storage/app
        $filesystem = Storage::disk('public');

        // buat dan isi file
        $filesystem->put("file.txt", "Hanif Aulia Kusuma");

        // baca file yang sudah dibuat disimpan pada variabel content
        $content = $filesystem->get('file.txt');

        // tes apakah isinya benar
        self::assertEquals("Hanif Aulia Kusuma", $content);
    }

    public function test_upload(){
        

        // buat simulasi file palsu
        // $image = UploadedFile::fake()->image("Hanif.png");
        $picture = UploadedFile::fake()->image('Hanif.png');

        $this->post('/file/upload', [
            'picture' => $picture
        ])->assertSeeText("OK: Hanif.png");
    }
}
