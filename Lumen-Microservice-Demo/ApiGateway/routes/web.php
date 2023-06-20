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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => ['client.credentials']], function () use ($router) {
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('/', ['uses' => 'ProductController@index']);
        $router->post('/', ['uses' => 'ProductController@store']);
        $router->get('/{product}', ['uses' => 'ProductController@show']);
        $router->patch('/{product}', ['uses' => 'ProductController@update']);
        $router->delete('/{product}', ['uses' => 'ProductController@destroy']);
    });
    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get('/', ['uses' => 'OrderController@index']);
        $router->post('/', ['uses' => 'OrderController@store']);
        $router->get('/{order}', ['uses' => 'OrderController@show']);
        $router->patch('/{order}', ['uses' => 'OrderController@update']);
        $router->delete('/{order}', ['uses' => 'OrderController@destroy']);
    });
});
