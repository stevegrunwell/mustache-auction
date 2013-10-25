@extends( 'layouts.base' )

@section( 'title', trans( 'user.create_form_title' ) )

@section( 'body' )

  <h1>{{ trans( 'user.signup_or_login_title' ) }}</h1>

  <div class="col">
    <h2>{{ trans( 'user.create_form_title' ) }}</h2>
    <p>{{ trans( 'user.create_form_body' ) }}</p>

    {{ Form::open( [ 'action' => 'UserController@create' ] ) }}

      @include( 'messages.errors' )

      <ul class="form-list">
        <li>
          {{ Form::label( 'first_name', trans( 'user.first_name' ), [ 'class' => 'required' ] ) }}
          {{ Form::text( 'first_name' ) }}
        </li>
        <li>
          {{ Form::label( 'last_name', trans( 'user.last_name' ), [ 'class' => 'required' ] ) }}
          {{ Form::text( 'last_name' ) }}
        </li>
        <li>
          {{ Form::label( 'email', trans( 'user.email' ), [ 'class' => 'required' ] ) }}
          {{ Form::email( 'email' ) }}
        </li>
        <li>
          {{ Form::label( 'password', trans( 'user.password' ), [ 'class' => 'required' ] ) }}
          {{ Form::password( 'password' ) }}
        </li>
        <li>
          <label for="accept_terms" class="required inline terms">{{ Form::checkbox( 'accept_terms', 1, null, [ 'id' => 'accept_terms' ] ) }} {{ trans( 'user.accept_terms' ) }}</label>
        </li>
      </ul>

      <p class="form-submit">{{ Form::submit( trans( 'user.create_form_submit' ) ) }}</p>

    {{ Form::close() }}
  </div>

  <div class="col">
    <h2>{{ trans( 'user.already_registered_title' ) }}</h2>
    <p>{{ trans( 'user.already_registered_body' ) }}</p>
    @include( 'user.login-form' )
  </div>

@stop