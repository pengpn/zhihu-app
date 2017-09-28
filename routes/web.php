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

Route::get('/','QuestionsContoller@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('email/verify/{token}',['as' => 'email.verify','uses' => 'EmailController@verify']);

Route::resource('questions','QuestionsContoller');

Route::post('/questions/{question}/answer','AnswersController@store')->name('answers.store');

Route::get('/questions/{question}/follow','QuestionFollowController@follow')->name('questions.follow');

Route::get('notifications','NotificationsController@index');
Route::get('notifications/{notification}','NotificationsController@show');


Route::get('avatar','UsersController@avatar');

Route::get('inbox','InboxController@index');
Route::get('inbox/{dialogId}','InboxController@show');
Route::post('inbox/{dialogId}/store','InboxController@store')->name('inbox.store');