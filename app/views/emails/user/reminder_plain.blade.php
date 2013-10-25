{{ trans( 'email/forgotpassword.body', [ 'link' => action( 'UserController@showResetPassword', [ 'token' => $token, 'email' => $user->email ] ) ] ) }}
{{ PHP_EOL . PHP_EOL }}
{{ trans( 'email/forgotpassword.body2' ) }}