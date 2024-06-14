<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->options('/{any:.*}', function () {
    return response('', 200);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users',  ['uses' => 'UserControllers@index']);
    $router->get('users/{id}', ['uses' => 'UserControllers@show']);
    $router->post('users', ['uses' => 'UserControllers@store']);
    $router->put('users/{id}', ['uses' => 'UserControllers@update']);
    $router->delete('users/{id}', ['uses' => 'UserControllers@destroy']);
});
