{{ Form::open( [ 'action' => 'UserController@login' ] ) }}

  @include( 'messages.errors' )

  <ul class="form-list">
    <li>
      {{ Form::label( 'email', trans( 'user.email' ), [ 'class' => 'required' ] ) }}
      {{ Form::email( 'email' ) }}
    </li>
    <li>
      {{ Form::label( 'password', trans( 'user.password' ), [ 'class' => 'required' ] ) }}
      {{ Form::password( 'password' ) }}
    </li>
  </ul>
  
  {{ link_to_action( 'UserController@showForgotPassword', trans( 'user.forgot_password_link' ), null, [ 'class' => 'forgot-password' ] ) }}

  <p class="form-submit">{{ Form::submit( trans( 'user.login_form_submit' ) ) }}</p>

{{ Form::close() }}