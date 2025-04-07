<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    //

    public function create(): Response
    {
        return response("Hello Cookie")
            // 1. key, 2. value, 3. timeout dalam menit, 4. path
            // jika akses path / maka cookie akan terkirim
            ->cookie('User-Id', "Hanif", 1000, '/')
            ->cookie('Is-Member', 'true', 1000, '/')
        ;
    }

    public function get_cookie(Request $request): JsonResponse
    {
        return response()
            ->json([
                'userId' => $request->cookie('User-Id', "Guest"),
                'isMember' => $request->cookie('Is-Member', 'false')
            ]);
    }

    public function clear_cookie(): Response
    {
        return response('Clear Cookie')
        ->withoutCookie('User-Id')
        ->withoutCookie('Is-Member')
        ;
    }
}
