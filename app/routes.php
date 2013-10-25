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
Route::get( 'forgot-password', 'UserController@showForgotPassword' );
Route::post( 'forgot-password', 'UserController@forgotPassword' );
Route::get( 'reset-password/{token}', 'UserController@showResetPassword' );
Route::post( 'reset-password/{token}', 'UserController@resetPassword' );

// Donations
Route::get( 'donate', 'BidController@create' );

// Contestant stats
Route::get( 'mobro/{contestant_id}', 'ContestantController@show' );

// Static pages
Route::get( 'about', 'HomeController@showAbout' );

// Everything in here requires the user to be logged in
Route::group( [ 'before' => 'auth' ], function () {

  Route::get( 'account', 'UserController@edit' );
  Route::put( 'account', 'UserController@update' );

  Route::post( 'donate', 'BidController@store' );

});

// Error pages
if ( ! Config::get( 'app.debug' ) ) {
  App::error( function ( $exception, $code ) {
    $custom_pages = array( 404 );
    return Response::view( 'errors.show', array( 'code' => ( in_array( $code, $custom_pages ) ? $code : 'default' ) ), $code );
  });
}