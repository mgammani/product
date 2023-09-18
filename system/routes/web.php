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

$app->get('/', function () use ($app) {
   return view('index');
});
$app->post('/login','AuthController@login');
$app->post('/logout','AuthController@logout');
$app->get('/auth','AuthController@auth');

$app->group(['middleware' => 'auth'], function () use ($app) {
    $app->post('/product','ProductController@store');
    $app->post('/account/update','AuthController@updatePassword');
    $app->post('batch','BatchController@store');
    $app->get('/batches','BatchController@index');
    $app->get('products','ProductController@index');
    $app->delete('/batch/{id}','BatchController@destroy');
    $app->delete('/product/{id}','ProductController@destroy');
    $app->patch('/batch/{id}','BatchController@update');
    $app->patch('/product/{id}','ProductController@update');
});
