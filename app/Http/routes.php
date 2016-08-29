<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

// Twitter
Route::get('add/twitter', 'TwitterController@redirectToProvider');
Route::get('add/twitter/callback', 'TwitterController@handleProviderCallback');
Route::get('twitter/dashboard', ['as'=>'twitter.dashboard' ,'uses'=>'TwitterController@dashboard']);
Route::post('twitter/dashboard/tweet', ['as'=>'twitter.tweet' ,'uses'=>'TwitterController@tweet']);
Route::post('twitter/dashboard/message', ['as'=>'twitter.message' ,'uses'=>'TwitterController@message']);


// Trello
Route::get('add/trello', 'TrelloController@redirectToProvider');
Route::get('add/trello/callback', 'TrelloController@handleProviderCallback');
Route::get('trello/dashboard', ['as'=>'trello.dashboard' ,'uses'=>'TrelloController@dashboard']);
Route::post('trello/dashboard/list', ['as'=>'trello.list' ,'uses'=>'TrelloController@create_list']);
Route::post('trello/dashboard/card', ['as'=>'trello.card' ,'uses'=>'TrelloController@create_card']);


