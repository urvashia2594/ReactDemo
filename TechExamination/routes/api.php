<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'namespace'=>'Api\V1',
    'prefix'=>'v1',
    'as'=> 'v1.'
],function($router){
    $router->post('register', 'Auth\AuthController@register');
    $router->post('login', 'Auth\AuthController@login');

    
    Route::middleware(['auth:api'])->group(function ($router) {
        $router->get('get-exam-list', 'ExamController@index');
        $router->get('question-list-from-examId/{exam}', 'ExamController@questionListFromExamId');
        $router->get('check-user_ability/{exam}', 'ExamController@checkUserAbilty');
        $router->post('submit-exam', 'ExamController@submitExam');
    });

});
