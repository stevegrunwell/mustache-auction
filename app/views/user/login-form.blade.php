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

  <p class="form-submit">{{ Form::submit( trans( 'user.login_form_submit' ) ) }}</p>

{{ Form::close() }}