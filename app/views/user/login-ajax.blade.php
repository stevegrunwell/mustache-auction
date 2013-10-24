<h2>{{ trans( 'user.login_form_title' ) }}</h2>
<p>{{ trans( 'user.login_to_bid' ) }}</p>
@include( 'user.login-form' )
<p>{{ trans( 'user.login_create_account', [ 'signup_link' => action( 'UserController@create' ) ] ) }}</p>