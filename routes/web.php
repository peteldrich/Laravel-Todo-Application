<?php

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

Route::get('/', 'TemplateController@todoList');
Route::get('/edit/{id}', 'TemplateController@todoEdit');
Route::get('/handleSubmitDeleteTodo/{id}', 'TodoController@delete');
Route::post('/handleSubmitAddTodo', 'TodoController@add');
Route::post('/handleSubmitUpdateTodo', 'TodoController@update');