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

Route::get('/', "QuestionsController@index");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/questions', 'QuestionsController')->except('show');
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');

Route::resource('questions.answers', "AnswersController")->except('create', 'show');

Route::post('/answer/{answer}/accept',"AcceptAnswersController")->name('answers.accept');

Route::post('/questions/{question}/favorite', 'FavoriteQuestionsController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorite', 'FavoriteQuestionsController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', "VoteQuestionsController")->name('questions.vote');
Route::post('/answers/{answer}/vote', "VoteAnswersController")->name('answers.vote');