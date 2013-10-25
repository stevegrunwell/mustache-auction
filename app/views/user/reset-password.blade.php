@extends( 'layouts.base' )

@section( 'title', trans( 'user.reset_password_title' ) )

@section( 'body' )

  {{ Form::open( [ 'action' => [ 'UserController@resetPassword', $token ], 'type' => 'put' ] ) }}

    <h1>{{ trans( 'user.reset_password_title' ) }}</h1>
    <p>{{ trans( 'user.reset_password_body' ) }}</p>

    @include( 'messages.errors' )

    <ul class="form-list">
      <li>
        {{ Form::label( 'email', trans( 'user.email' ), [ 'class' => 'required' ] ) }}
        {{ Form::email( 'email', $email ) }}
      </li>
      <li>
        {{ Form::label( 'password', trans( 'user.new_password' ), [ 'class' => 'required' ] ) }}
        {{ Form::password( 'password' ) }}
      </li>
      <li>
        {{ Form::label( 'password_confirmation', trans( 'user.confirm_password' ), [ 'class' => 'required' ] ) }}
        {{ Form::password( 'password_confirmation' ) }}
      </li>
    </ul>
    {{ Form::hidden( 'token', $token ) }}

    <p class="form-submit">{{ Form::submit( trans( 'user.reset_password_btn' ) ) }}</p>

  {{ Form::close() }}

@stop