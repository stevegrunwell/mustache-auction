<?php

class HomeController extends BaseController {

  /*
  |--------------------------------------------------------------------------
  | Default Home Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  | Route::get('/', 'HomeController@showWelcome');
  |
  */

  public function index() {
    return View::make( 'home' )->with( 'contestants', Contestant::orderBy( 'first_name' )->get() );
  }

  public function showAbout() {
    $placeholders = array(
      'appname' => trans( 'global.appname' )
    );
    return View::make( 'static' )->with( array( 'page' => 'about', 'placeholders' => $placeholders ) );
  }

}