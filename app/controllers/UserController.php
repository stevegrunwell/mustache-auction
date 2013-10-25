<?php

class UserController extends BaseController {

  public function create() {
    return View::make( 'user.create' );
  }

  public function store() {
    $validation = Validator::make( Input::get(), User::getValidationRules( 'create' ) );
    if ( $validation->fails() ) {
      return Redirect::back()->withErrors( $validation )->withInput( Input::except( 'password' ) );
    }

    // Build the User object
    $password = Input::get( 'password' );
    $user = new User;
    $user->email = Input::get( 'email' );
    $user->password = $password;
    $user->first_name = Input::get( 'first_name' );
    $user->last_name = Input::get( 'last_name' );

    if ( $user->save() ) {
      // Auto-login the user
      if ( Auth::attempt( [ 'email' => $user->email, 'password' => $password ], true ) ) {
        $user->touchLogin();
        return Redirect::to( '/' )->with( 'success', trans( 'user.msg_welcome_new_user' ) );
      } else {
        return Redirect::to( '/' )->with( 'error', trans( 'user.msg_unable_to_auto_login' ) );
      }
    } else {
      Redirect::back()->with( 'error', trans( 'users.error_creating_user' ) );
    }
  }

  public function edit() {
    return View::make( 'user.edit' )->with( 'user', Auth::user() );
  }

  public function update() {
    $validation = Validator::make( Input::all(), User::getValidationRules( 'edit' ) );
    if ( $validation->fails() ) {
      return Redirect::back()->withErrors( $validation )->withInput( Input::except( 'password', 'password_confirm' ) );
    }

    $user = Auth::user();
    $user->email = Input::get( 'email' );
    $user->first_name = Input::get( 'first_name' );
    $user->last_name = Input::get( 'last_name' );

    // Change password
    if ( Input::get( 'password' ) ) {
      $user->password = Input::get( 'password' );
    }

    if ( $user->save() ) {
      return Redirect::to( '/' )->with( 'success', trans( 'user.msg_account_update_successful' ) );
    } else {
      return Redirect::back()->with( '/', trans( 'user.msg_account_update_error' ) );
    }
  }

  public function showLogin() {
    return View::make( 'user.login' );
  }

  public function login() {
    $rules = array(
      'email'    => 'required|email',
      'password' => 'required'
    );

    // run the validation rules on the inputs from the form
    $validator = Validator::make( Input::all(), $rules );

    // if the validator fails, redirect back to the form
    if ( $validator->fails() ) {
      return Redirect::to( 'login' )->withErrors( $validator )->withInput( Input::except( 'password' ) );

    // Validation passed, attempt to authenticate
    } else {
      if ( Auth::attempt( array( 'email' => Input::get( 'email' ), 'password' => Input::get( 'password' ) ), true ) ) {
        return Redirect::to( '/' );

      } else {
        return Redirect::to( 'login' )->with( 'error', trans( 'forms.login_failure' ) )->withInput( Input::except( 'password' ) );
      }
    }
  }

  public function showForgotPassword() {
    return View::make( 'user.forgot-password' )->with( 'email', Input::get( 'email' ) );
  }

  public function forgotPassword() {
    $email = Input::get( 'email' );
    Session::flash( 'email', $email );
    return Password::remind( array( 'email' => $email ), function ( $message, $user ) {
      $message->subject( trans( 'email/forgotpassword.subject', [ 'appname' => trans( 'global.appname' ) ] ) );
    });
  }

  public function showResetPassword( $token ) {
    return View::make( 'user.reset-password' )->with( array( 'token' => $token, 'email' => Input::get( 'email' ) ) );
  }

  public function resetPassword() {
    return Password::reset( array( 'email' => Input::get( 'email' ) ), function ( $user, $password ) {
      $user->password = $password;
      $user->save();
      if ( Auth::attempt( [ 'email' => $user->email, 'password' => $password ], true ) ) {
        return Redirect::to( '/' )->with( 'success', trans( 'user.msg_password_reset_successful' ) );
      }
    });
  }

  public function logout() {
    Auth::logout();
    return Redirect::to( '/' )->with( 'success', trans( 'user.msg_logout_successful' ) );
  }

}