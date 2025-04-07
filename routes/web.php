<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Hanif";
});

// jika akses yutub maka redirect ke pzn
Route::redirect('/youtube', '/pzn');

// jika tidak ada maka menampilkan 404
Route::fallback(function () {
    return "404";
});

// akses hello akan diarahkan ke hello blade, dengan parameter nama
Route::view('/hello', 'hello', ['name' => 'Hanif']);

// akses hello again
Route::get('/hello-again', function () {
    // diarahkan ke view hello
    return view('hello', ['name' => 'Hanif']);
});

Route::get('/hello-world', function () {
    // diarahkan ke view hello
    return view('hello.world', ['name' => 'Hanif']);
});


// chain name hanya untuk penamaan route

// route parameter
// parameter di dalam closure {}, parameter {id} akan di salin dan dimasukkan sebagai argumen dari fungsi yaitu $productId
Route::get('/products/{id}', function ($productId) {
    return "Products: " . $productId;
})->name('product.detail');

// nama parameter di url tidak harus sama dengan parameter di fungsi, perwakilanya dilihat berdasarkan urutan contoh
// parameter url product = parameter fungsi $productId
// parameter url item = parameter fungsi $itemId
Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products: " . $productId . ", Items: " . $itemId;
})->name('product.item.detail');

// parameter url id wajib diisi angka 0-9
Route::get('/categories/{id}', function (string $categoryId) {
    return "Categories: " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

// parameter yang tidak wajib diisi cukup tambahkan ?
Route::get('/users/{id?}', function (string $userId = "404") {
    return "Users: " . $userId;
})->name('user.detail');

Route::get('/conflict/{name}', function (string $name) {
    return 'Conflict: ' . $name;
});

Route::get('/conflict/hanif', function () {
    return 'Conflict: Hanif AK';
});

//jika akses produk id, maka mengembalikan url route dengan nama product.detail 
Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});


//jika akses product-redirect id, maka mengembalikan url route dengan nama product.detail
Route::get('/product-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

// jika di url adalah /controller/hello maka akan akses pada class HelloController method hello
// Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']);

// jika ada parameter pada url = {name} dan merupakan parameter pertama, paka tidak perlu memberikan default parameter pada actionnya
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);


Route::get('/controller/hellobro/request', [\App\Http\Controllers\HelloController::class, 'request']);

// test request input
Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);


Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);
Route::post('/input/hello/input', [\App\Http\Controllers\InputController::class, 'helloInput']);

Route::post('/input/hello/inputcity', [\App\Http\Controllers\InputController::class, 'helloInputCity']);

Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);


Route::post('/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);

Route::post('/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

Route::post('/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])
;

// Route::post('/file/upload', [\App\Http\Controllers\FileStorageTest::class, 'upload']);

// MACAM MACAM RESPONSE THINGS

Route::get('/response/default', [\App\Http\Controllers\ResponseController::class, 'response']);

Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

Route::get('/response/view', [\App\Http\Controllers\ResponseController::class, 'response_view']);

Route::get('/response/json', [\App\Http\Controllers\ResponseController::class, 'response_json']);

Route::get('/response/file', [\App\Http\Controllers\ResponseController::class, 'response_file']);

Route::get('/response/download', [\App\Http\Controllers\ResponseController::class, 'response_download']);

//cookie things
// Route::get('/cookie/create', [\App\Http\Controllers\CookieController::class, 'create']);
// Route::get('/cookie/get', [\App\Http\Controllers\CookieController::class, 'get_cookie']);
// Route::get('/cookie/clear', [\App\Http\Controllers\CookieController::class, 'clear_cookie']);

// jika berupa group controller
Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    Route::get('/cookie/create', 'create');
    Route::get('/cookie/get', 'get_cookie');
    Route::get('/cookie/clear', 'clear_cookie');
});



// REDIRECT THINGS
Route::get('/redirect/from', [\App\Http\Controllers\RedirectController::class, 'redirect_from']);
Route::get('/redirect/to', [\App\Http\Controllers\RedirectController::class, 'redirect_to']);



Route::get('/redirect/name', [\App\Http\Controllers\RedirectController::class, 'redirect_name']);
Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirect_hello'])
    ->name('redirect-hello');

Route::get('/url/named', function () {
    return route('redirect-hello', ['name' => 'Hanif']);
});

Route::get('/redirect/action', [\App\Http\Controllers\RedirectController::class, 'redirect_action']);

Route::get('/redirect/mediato', [\App\Http\Controllers\RedirectController::class, 'redirect_away']);


// penggunaan middleware route

Route::get('/middleware/api', function () {
    return "OK";
})
    // menggunakan classnya
    ->middleware([\App\Http\Middleware\ContohMiddleware::class])
    // menggunakan aliasnya
    // ->middleware(['contoh'])
;

// penggunaan group middleware
// 1. jika di ungroup
Route::get('/middleware/group', function () {
    return "GROUP";
})->middleware(['pzn']);

Route::get('/middleware/param', function () {
    return "PARAM";
})->middleware(['param:PZN,401']);

// 2.jika di group
// Route::middleware(['contoh:PZN,201'])->group(function () {
//     Route::get('/middleware/api', function () {
//         return "OK";
//     });

//     Route::get('/middleware/group', function () {
//         return "GROUP";
//     });
// });

Route::get('/url/action', function () {
    // return action([\App\Http\Controllers\FormController::class], []);
    // return url()->action([\App\Http\Controllers\FormController::class], []);
    return \Illuminate\Support\Facades\URL::action([\App\Http\Controllers\FormController::class], []);
});
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitForm']);

Route::prefix('/response/type/')->group(function () {
    Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'response_view']);
    Route::get('/json', [\App\Http\Controllers\ResponseController::class, 'response_json']);
    Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'response_file']);
    Route::get('/download', [\App\Http\Controllers\ResponseController::class, 'response_download']);
});

// multiple Route Group
Route::middleware(['sample:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
});

// url generator
Route::get('/url/current', function () {
    return \Illuminate\Support\Facades\Url::full();
});

// SESSION THINGS
Route::controller(\App\Http\Controllers\SessionController::class)->prefix('/session')->group(function () {
    Route::get('/create', 'create_session');
    Route::get('/get', 'get_session');
});

// EXCEPTION HANDLER THINGS
Route::get('/error/sample', function () {
    throw new Exception("Sample Error");
});

Route::get('/error/manual', function () {
    report(new Exception("Sample Error"));
    return "OK";
});

Route::get('/error/validation', function () {
    throw new \App\Exceptions\ValidationException("Validation Error");
});

// HTTP Exception THings
Route::get('/abort/400', function () {
    abort(400, "Ups Validation Error");
});
Route::get('/abort/401', function () {
    abort(401);
});
Route::get('/abort/500', function () {
    abort(500);
});