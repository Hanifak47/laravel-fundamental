<?php

namespace App\Http\Controllers;

use App\Services\HelloService;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    private HelloService $helloService;

    public function __construct(HelloService $helloService)
    {
        return $this->helloService = $helloService;
    }

    public function hello(Request $request, string $name): string
    {
        // $request->path();
        // $request->url();
        // $request->fullUrl();

        // cek jenis method
        // $reqeust->method
        // $request->isMethod("post");

        // mendapatkan data header dengan key parameter
        // $request->header(key);
        // $request->header(key, default); jika tidak ada data key parameter maka gunakan data default

        // mendapatkan informasi token bearer
        // $request->bearerToken();


        return $this->helloService->hello($name);
    }
    // public function hello()
    // {
    //     return 'Hello World';
    // }

    // public function request(Request $request)
    // {
    //     return $request->path() . PHP_EOL .
    //         $request->url() . PHP_EOL .
    //         $request->fullUrl() . PHP_EOL .
    //         $request->method() . PHP_EOL .
    //         $request->header("Accept") . PHP_EOL;

    //     // return "jos banget";
    // }
}
