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

Route::get('/', 'PagesController@home');
Route::get('/home', 'PagesController@home');

Route::get('/about', 'PagesController@about');

Route::get('/contact', 'TicketsController@create');
Route::post('/contact', 'TicketsController@store');

Route::get('/tickets', 'TicketsController@index');
Route::get('/tickets/{slug}', 'TicketsController@show');
Route::get('/tickets/{slug}/edit','TicketsController@edit');
Route::get('/tickets/{slug}/delete','TicketsController@destroy');
Route::post('/tickets/{slug}/edit','TicketsController@update');

Route::post('/comment','CommentsController@newComment');

Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');
Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');
Route::get('users/logout', 'Auth\AuthController@getLogout');

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'manager'), function () {
    Route::get('users', [ 'as' => 'admin.user.index', 'uses' => 'UsersController@index']);
    Route::get('roles', 'RolesController@index');
    Route::get('roles/create', 'RolesController@create');
    Route::post('roles/create', 'RolesController@store');
});




Route::get('sendemail', function () {
    $data = array(
        'name' => "Learning Laravel",
    );
    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('fbisurveilancevan@fbi.org', 'Learning Laravel');
        $message->to('grantskipper_2017@depauw.edu')->subject('Learning Laravel test email');
    });
    return "Your email has been sent successfully";
});
