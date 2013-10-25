@extends( 'layouts.email' )

@section( 'body' )

  <h1>{{ trans( 'email/forgotpassword.heading' ) }}</h1>
  <p>{{ trans( 'email/forgotpassword.body', [ 'link' => action( 'UserController@showResetPassword', [ 'token' => $token, 'email' => $user->email ] ) ] ) }}</p>
  <p>{{ trans( 'email/forgotpassword.body2' ) }}</p>

@stop