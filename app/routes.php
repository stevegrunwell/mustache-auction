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

Route::get( '/', 'HomeController@index' );

// User registration/login/logout
Route::get( 'join', 'UserController@create' );
Route::post( 'join', 'UserController@store' );
Route::get( 'login', 'UserController@showLogin' );
Route::post( 'login', 'UserController@login' );
Route::get( 'logout', 'UserController@logout' );

Route::get( 'donate', 'BidController@create' );

// Everything in here requires the user to be logged in
Route::group( [ 'before' => 'auth|ssl' ], function () {

  Route::get( 'account', 'UserController@edit' );
  Route::put( 'account', 'UserController@update' );

  Route::post( 'donate', 'BidController@store' );

});