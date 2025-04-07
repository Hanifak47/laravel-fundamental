<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;

class InputController extends Controller
{
    //
    public function hello(Request $request): string
    {
        // $name = $request->input('name');
        $name = $request->name;
        return "Hello " . $name;
        // return "Hello Hanif";
    }

    public function helloFirst(Request $request): string
    {
        $firstName = $request->input('name.first');
        return "Hello $firstName";
    }

    public function helloInput(Request $request)
    {
        $input = $request->input();
        return json_encode($input);
    }

    public function helloInputCity(Request $request)
    {
        $input = $request->input('Address.*.city');
        return json_encode($input);
    }

    public function inputType(Request $request)
    {
        $name = $request->input('name');
        $married = $request->boolean('married');
        $birth_date = $request->date('birth_date', 'Y-m-d');

        return json_encode([
            'name' => $name,
            'married' => $married,
            'birth_date' => $birth_date->format('Y-m-d')
        ]);
    }

    public function filterOnly(Request $request)
    {
        $name = json_encode($request->only(['name.firstname', 'name.lastname']));
        return $name;
    }

    public function filterExcept(Request $request)
    {
        $user = $request->except(['admin']);
        return json_encode($user);
    }

    public function filterMerge(Request $request)
    {
        $request->merge(['admin' => false]);
        return json_encode($request->input());
    }
}
