<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->get('/', function () use ($router) {
    return view("index");
});

$router->post('/confirm', 'Ocr@test');

// $router->post('/confirm', function (Request $request) use ($router) {
//     $from_lang = $request->input('from_lang');
//     $to_lang = $request->input('to_lang');
//     $post = compact('from_lang', 'to_lang');
//     return view("confirm", $post);
// });

$router->get('/test', 'Ocr@test');
