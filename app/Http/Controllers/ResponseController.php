<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

// use Symfony\Component\;

class ResponseController extends Controller
{
    //

    public function response(): Response
    {
        return response("Hello response");
    }

    public function header(): Response
    {
        $body = ['firstName' => 'Hanif', 'lastName' => 'Kusuma'];
        return response(json_encode($body), 200)
            ->header('Content-Type', 'application/json')
            ->withHeaders([
                'Author' => 'Sans Coding',
                'App' => 'Belajar Laravel'
            ])
        ;
    }

    public function response_view(): Response
    {
        return response()
            ->view('hello', ['name', 'Hanif Aulia Kusuma']);
    }

    public function response_json(): JsonResponse
    {
        $body = ['firstname' => 'Hanif', 'lastname' => 'Kusuma'];
        return response()
            ->json($body);
    }

    // render file
    public function response_file(): BinaryFileResponse
    {
        return response()
            ->file(storage_path('app/public/pictures/hanif.png'));
    }

    // download file
    public function response_download(): BinaryFileResponse
    {
        return response()
            ->download(storage_path('app/public/pictures/hanif.png'), 'Hanif.png');
    }
}
