<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    //normal redirect
    public function redirect_to(): string
    {
        return "Redirect To";
    }

    public function redirect_from(): RedirectResponse
    {
        return redirect('/redirect/to');
    }


    // redirect name
    public function redirect_name(): RedirectResponse
    {
        // redirect ke route yang bernama redirect-hello, dengan parameter name
        return redirect()->route('redirect-hello', ['name' => 'Hanif']);
    }

    public function redirect_hello(string $name): string
    {
        return "Hello $name";
    }

    // redirect action
    public function redirect_action(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirect_hello'], ['name' => 'Hanif']);
    }

    public function redirect_away()
    {
        return redirect()->away('https://mediato.site/lms/pengguna/login');
    }
}
