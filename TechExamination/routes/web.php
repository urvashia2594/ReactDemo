<?php

use Illuminate\Support\Facades\Route;
// use   App\Http\Controllers\Admin\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$router->get('/','Admin\Auth\AuthController@showLoginForm')->name('home');

Route::group([
    'namespace'=>'Admin',
    'prefix'=>'admin',
    'as'=>'admin.'
],function($router){
    $router->get('login','Auth\AuthController@showLoginForm')->name('showlogin');
    $router->post('login','Auth\AuthController@Login')->name('login');
    $router->post('logout','Auth\AuthController@logout')->name('logout');

    Route::middleware(['auth'])->group(function($router){
        $router->get('dashboard','DashboradController@index')->name('dashboard');
        $router->resource('user','UserController');
        $router->resource('subject', 'SubjectController');
        $router->resource('questions', 'QuestionController');
        $router->resource('answer', 'AnswerController');
        $router->resource('exam', 'ExamController');
    });
});


