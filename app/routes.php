<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=>'home', 'uses'=>'QuestionController@index'));

Route::get('login', array('as'=>'login', 'uses'=>'UserController@getLogin'));
Route::get('logout', array('as'=>'logout', 'uses'=>'UserController@getLogout'));
Route::get('your-questions', array('as'=>'your_questions', 
    'uses'=>'QuestionController@indexYourQuestions'));
Route::get('results/{id}', array('uses'=>'QuestionController@getResults'));

Route::post('login', array('before'=>'csrf', 'uses'=>'UserController@postLogin'));
Route::post('search', array('as'=>'search', 'before'=>'csrf', 
    'uses'=>'QuestionController@postSearch'));

Route::resource('questions', 'QuestionController', array(
    'except'=>array('create','destroy')));

Route::resource('users', 'UserController', array(
    'only'=>array('create','store')));

Route::resource('answers', 'AnswerController', array(
    'only'=>array('store')));


